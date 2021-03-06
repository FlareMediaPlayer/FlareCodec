<?php

/**
 *
 * @author Brian Parra
 */

namespace Flare\Formats\Iso\Presentation;

class Track {
    
    protected $handlerType;
    protected $trakID;
    protected $tkhd;
    protected $boxMap;
    protected $mdhd;
    protected $hdlr;
    protected $minf;
    protected $stbl;
    protected $stts;
    protected $stsz;
    protected $stsc;
    protected $stco;
    protected $deltaTable;
    protected $chunkCount;
    protected $chunkOffsetTable;
    protected $sampleSizeTable;
    protected $chunkTable;
    protected $chunkRunTable;
    protected $sampleCount; 
    protected $currentSample = 0;
    protected $sampleRate = 48000; // for now this is usually the sample rate for movies
    protected $sampleToChunkTable;
    protected $currentChunk = 0;
    protected $lastChunk = 0;
    protected $currentWriteLocation;
    protected $consecutiveWriteLocation;
    protected $duration = 0;
    protected $durationInRealTime = 0;
    protected $expandedDataTable;
    
    protected $trak;
    protected $file;
    protected $movie; // Reference to the movie container;
    protected $trackType;
    
    protected $height = 0;
    protected $width = 0;
    
    protected $volume;
    
    //Available Track Types
    public static $trackTypes = [
        0 => "Generic/Unknown",
        1 => "Video",
        2 => "Audio"
    ];

    public function __construct($movie) {
        $this->trackType = self::$trackTypes[0];
        $this->movie = $movie;
        $this->handlerType = \Flare\Formats\Iso\Boxes\Hdlr::NULL_HANDLER;
        
    }

    public function setMovie($movie) {

        $this->movie = $movie;
    }
    
    public function getMovie(){
        return $this->movie;
    }

    public function getTrak() {
        //
        return $this->trak;
    }

    public function getType() {
        return $this->trackType;
    }

    public static function createMappedTrack($trak, $movie) {

        $track;

        //Figure out the type of track
        $mdia = $trak->getBoxByClass(\Flare\Formats\Iso\Box::$boxTable[\Flare\Formats\Iso\Box::MDIA]);
        $hdlr = $mdia->getBoxByClass(\Flare\Formats\Iso\Box::$boxTable[\Flare\Formats\Iso\Box::HDLR]);
        $handlerType = $hdlr->getHandlerType();

        //If available instantiate
        switch ($handlerType) {
            case \Flare\Formats\Iso\Boxes\Hdlr::SOUN:
                $track = new AudioTrack($movie);
                break;
            case \Flare\Formats\Iso\Boxes\Hdlr::VIDE:
                $track = new VideoTrack($movie);
                break;
            default:
                $track = new Track($movie);
            //instantiate an unknown
        }

        

        return $track;
    }
    
    public static function createNewTrack($movie, $handlerType){
        //If available instantiate
        switch ($handlerType) {
            case \Flare\Formats\Iso\Boxes\Hdlr::SOUN:
                $track = new AudioTrack($movie);
                break;
            case \Flare\Formats\Iso\Boxes\Hdlr::VIDE:
                $track = new VideoTrack($movie);
                break;
            default:
                $track = new Track($movie);
            //instantiate an unknown
        }
        
        return $track;
    }

    public function mapFromTrak($trak) {
        $this->trak = $trak;
        $this->boxMap = $trak->getBoxMap();
        $this->file = $trak->getFile();
        $this->expandedDataTable = [];
        $this->buildDecodeTable();
        
        //Now import specific properties for user friendly access
        $this->trakID = $this->tkhd->getTrackID();
        
    }

    private function buildDecodeTable() {


        $this->tkhd = $this->trak->getBoxByClass('\Flare\Formats\Iso\Boxes\Tkhd');
        $this->mdia = $this->trak->getBoxByClass('\Flare\Formats\Iso\Boxes\Mdia');
        $this->mdhd = $this->mdia->getBoxByClass('\Flare\Formats\Iso\Boxes\Mdhd');
        $this->hdlr = $this->mdia->getBoxByClass('\Flare\Formats\Iso\Boxes\Hdlr');
        $this->minf = $this->mdia->getBoxByClass('\Flare\Formats\Iso\Boxes\Minf');
        $this->stbl = $this->minf->getBoxByClass('\Flare\Formats\Iso\Boxes\Stbl');


        $this->stts = $this->stbl->getBoxByClass('\Flare\Formats\Iso\Boxes\Stts');
        $this->stsc = $this->stbl->getBoxByClass('\Flare\Formats\Iso\Boxes\Stsc');
        $this->stsz = $this->stbl->getBoxByClass('\Flare\Formats\Iso\Boxes\Stsz');
        $this->stco = $this->stbl->getBoxByClass('\Flare\Formats\Iso\Boxes\Stco');
        $this->chunkCount = $this->stco->getEntryCount();


        $this->deltaTable = $this->stts->getDeltaTable();
        $this->chunkOffsetTable = $this->stco->getChunkOffsetTable();
        $this->sampleSizeTable = $this->stsz->getSampleSizeTable();
        $this->sampleCount = $this->stsz->getSampleCount();
        $this->chunkTable = $this->stsc->getChunkTable(); //sampleTableBox
        $this->chunkTableEntryCount = $this->stsc->getChunkTableEntryCount();


        
        //FULL DATA TABLE
        for ($i = 0; $i < $this->sampleCount; $i++) {
            $this->expandedDataTable[$i]["byteCount"] = $this->sampleSizeTable[$i]; //bytes per sample    
        }

        //Now decode the chunkTable
        //Chunk run table for size = 1 wont work!!
        for ($i = 1; $i < $this->chunkTableEntryCount; $i++) {

            $this->chunkRunTable[$i - 1] = [
                $this->chunkTable[$i][0] - $this->chunkTable[$i - 1][0],
                $this->chunkTable[$i - 1][1],
                $this->chunkTable[$i - 1][2]
            ]; //Num of chunks that are the same, samples/chunk, desc index
        }

        $this->chunkRunTable[] = [
            $this->chunkCount - $this->chunkTable[$this->chunkTableEntryCount - 1][0],
            $this->chunkTable[$this->chunkTableEntryCount - 1][1],
            $this->chunkTable[$this->chunkTableEntryCount - 1][2]
        ]; //Num of chunks that are the same, samples/chunk, desc index

        $currentSample = 0;
        $currentChunk = 0;
        $offset = 0;
        $deltaTableIndex = 0; //Use these to decode the delta table without wasting more arrays
        $deltaTableCounter = 0; //Use these to decode the delta table without wasting more arrays
        

        for ($i = 0; $i < count($this->chunkRunTable); $i++) {

            for ($n = 0; $n < $this->chunkRunTable[$i][0]; $n++) { //each one of these chunks is the same num of samples
                $offset = $this->chunkOffsetTable[$currentChunk]; //offset to the beginning of each chunk

                for ($x = 0; $x < $this->chunkRunTable[$i][1]; $x++) {
                    $this->expandedDataTable[$currentSample]["offset"] = $offset; // the overall offset
                    $this->expandedDataTable[$currentSample]["chunk"] = $i; // the chunk that it belongs to
                    $this->expandedDataTable[$currentSample]["sampleDescriptionIndex"] = $this->chunkRunTable[$i][2]; // desc
                    $this->expandedDataTable[$currentSample]["delta"] = $this->deltaTable[$deltaTableIndex]["sampleDelta"];
                    
                    $deltaTableCounter++;
                    
                    if($deltaTableCounter == $this->deltaTable[$deltaTableIndex]["sampleCount"]){
                       $deltaTableIndex++;
                       $deltaTableCounter = 0;
                    }
                        

                    $offset+= $this->expandedDataTable[$currentSample]["byteCount"];
                    
                    $currentSample++;
                }

                $currentChunk++;
            }
        }
        
    }



    public function readSample(&$sample) {
        fseek($this->file, $this->expandedDataTable[$this->currentSample]["offset"]);
        $sample = fread($this->file, $this->expandedDataTable[$this->currentSample]["byteCount"]);
        $metaData = $this->expandedDataTable[$this->currentSample];
        $this->currentSample++;
        return $metaData;
    }

    public function writeSample($sample, $sampleMeta) {

        $this->currentWriteLocation = ftell($this->file); //record the current write location
        if ($this->currentSample > 0) {
            if ($this->currentWriteLocation != $this->consecutiveWriteLocation) {
                $this->currentChunk++;
                $this->chunkOffsetTable[] = $this->currentWriteLocation;
            }
        } else {
            //Record the offset to the first chunk
            $this->chunkOffsetTable[] = $this->currentWriteLocation;
        }

        $this->consecutiveWriteLocation = $this->currentWriteLocation + $sampleMeta["byteCount"];

        $this->duration+= $sampleMeta["delta"]; //add up the duration
        
        
        $this->expandedDataTable[] = [
            "byteCount" => $sampleMeta["byteCount"],
            "offset" => ftell($this->file),
            "chunk" => $this->currentChunk,
            "sampleDescriptionIndex" => $sampleMeta["sampleDescriptionIndex"], 
            "delta" => $sampleMeta["delta"]
        ];
        
        $this->chunkRunTable[] = $this->currentChunk;
        
        fwrite($this->file, $sample);
        $this->currentSample++; // advance the current sample
    }

    public function setCurrentSample($currentSample) {
        $this->currentSample = $currentSample;
    }

    public function getSampleCount() {

        return $this->sampleCount;
    }

    public function finalize() {
        $this->sampleCount = count($this->expandedDataTable);
        $this->durationInRealTime = $this->duration / $this->sampleRate * 1000;
        $this->mdhd->setTimeScale($this->sampleRate);
        $this->mdhd->setDuration($this->duration);
        $this->tkhd->setDuration($this->durationInRealTime);
        $this->tkhd->setTrackID($this->trackID);
        $this->tkhd->setAlternateGroup(1); //0 doesn't work for some reason

        $segmentTable = array(["segmentDuration" => $this->durationInRealTime, "mediaTime" => 0]);
        $this->elst->setSegmentTable($segmentTable);
        $this->elst->setMediaRateInteger(1);

        $this->encodeDeltaTable();
        $this->encodeChunkTable();
        $this->encodeSampleSizeTable();

        //we first have to encode the 4 tables, stts, stsc, stsz, stco
        $this->stts->setDeltaTable($this->deltaTable);
        $this->stsc->setChunkTable($this->chunkTable);
        $this->stsz->setSampleSizeTable($this->sampleSizeTable);
        $this->stco->setChunkOffsetTable($this->chunkOffsetTable);

    }

    private function encodeDeltaTable() {

        $delta = $this->expandedDataTable[0]["delta"];
        $deltaCount = 1;
        for ($i = 1; $i < count($this->expandedDataTable); $i++) {
            if ($delta == $this->expandedDataTable[0]["delta"]) {
                $deltaCount++;
            } else {
                $this->deltaTable[] = ["sampleCount" => $deltaCount, "sampleDelta" => $delta];
                $delta = $this->expandedDataTable[0]["delta"];
                $deltaCount = 1;
            }
        }
        $this->deltaTable[] = ["sampleCount" => $deltaCount, "sampleDelta" => $delta];
        
    }

    private function encodeChunkTable() {
        //NEED TO CALCULATE CHUNK RUNS FIRST
        
        $firstChunk = $this->chunkRunTable[0];
        $samplesPerChunk = 1;

        $sampleDescriptionIndex = 1; //hardcode for now, but usually sample type shouldnt change
        for ($i = 1; $i < count($this->chunkRunTable); $i++) {
            if ($firstChunk == $this->chunkRunTable[$i]) {
                $samplesPerChunk++;
            } else {
                $this->chunkTable[] = [$firstChunk + 1, $samplesPerChunk, $sampleDescriptionIndex];
                $firstChunk = $this->chunkRunTable[$i];
                $samplesPerChunk = 1;
            }
        }
        $this->chunkTable[] = [$firstChunk + 1, $samplesPerChunk, $sampleDescriptionIndex];
        
        
        /**
         * New Version!
         */
       
        /*
      
        $firstChunkData = $this->expandedDataTable[0];
        $chunkCounter = 1;
        $sampleCounter = 1;
        $chunkRunCounter = 1;
        for($i = 1; $i < count($this->expandedDataTable); $i++){
            //If they are in the same chunk, compare esd index, and samples
            if($this->expandedDataTable[$i]["chunk"] == $firstChunkData["chunk"]){
                if($this->expandedDataTable[$i]["sampleDescriptionIndex"] == $firstChunkData["sampleDescriptionIndex"]){
                    $sampleCounter++;
                }
            }else{
                $this->chunkTable[] = [$firstChunkData["chunk"] + 1, $sampleCounter, $firstChunkData["sampleDescriptionIndex"]];
            }
            
        }*/
       
         
        
    }

    private function encodeSampleSizeTable() {
        for ($i = 0; $i < count($this->expandedDataTable); $i++) {
            $this->sampleSizeTable[] = $this->expandedDataTable[$i]["byteCount"];
        }
    }

    public function getDurationInRealTime() {
        return $this->durationInRealTime;
    }

    public function setTrackID($ID) {
        $this->trackID = $ID;
    }
    
    public function getTrackID(){
        return $this->trakID;
    }


    public function getHandlerType(){
        return $this->handlerType;
    }

}
