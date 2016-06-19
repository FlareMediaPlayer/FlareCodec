<?php

/**
 * Description of AudioTrack
 *
 * @author Brian Parra
 */

namespace Flare\Formats\Iso\Presentation;

class AudioTrack extends \Flare\Formats\Iso\Presentation\Track {

    private $tkhd;
    private $boxMap;
    private $mdhd;
    private $hdlr;
    private $minf;
    private $stbl;
    private $stts;
    private $stsz;
    private $stsc;
    private $stco;
    private $deltaTable;
    private $chunkCount;
    private $chunkOffsetTable;
    private $sampleSizeTable;
    private $chunkTable;
    private $chunkRunTable;
    private $sampleCount;
    private $dataMap; //[offset, number of samples, bytes per sample ]  
    private $sampleToChunkMap;
    private $currentSample = 0;
    private $fullSampleMap; //This is the fully decompressed sample table = [offset, byteCount, delta]
    private $sampleRate = 48000; // for now this is usually the sample rate for movies
    private $sampleToChunkTable;
    private $currentChunk = 0;
    private $currentWriteLocation;
    private $consecutiveWriteLocation;
    private $duration = 0;
    private $durationInRealTime = 0;
    private $expandedDataTable;

    public function __construct($movie) {

        $this->fullSampleMap = [];
        $this->sampleSizeTable = [];
        $this->deltaTable = [];
        $this->sampleToChunkTable = [];
        $this->chunkOffsetTable = [];
        $this->expandedDataTable = [];

        $this->movie = $movie;
        $this->file = $this->movie->getFile();
        //We have to build an entire trak, then copy details over if available
        //For now this one is an audio track

        $this->trak = new \Flare\Formats\Iso\Boxes\Trak($this->file);


        $this->tkhd = new \Flare\Formats\Iso\Boxes\Tkhd($this->file);
        $this->tkhd->setVolume(1);
        $this->trak->addBox($this->tkhd);
        
        $this->edts = new \Flare\Formats\Iso\Boxes\Edts($this->file);
        $this->trak->addBox($this->edts);
        
        $this->elst = new \Flare\Formats\Iso\Boxes\Elst($this->file);
        $this->edts->addBox($this->elst);

        $this->mdia = new \Flare\Formats\Iso\Boxes\Mdia($this->file);
        $this->trak->addBox($this->mdia);

        $this->mdhd = new \Flare\Formats\Iso\Boxes\Mdhd($this->file);
        $this->mdia->addBox($this->mdhd);

        $this->hdlr = new \Flare\Formats\Iso\Boxes\Hdlr($this->file);
        $this->hdlr->setHandlerType(\Flare\Formats\Iso\Boxes\Hdlr::SOUN);
        $this->mdia->addBox($this->hdlr);

        $this->minf = new \Flare\Formats\Iso\Boxes\Minf($this->file);
        $this->mdia->addBox($this->minf);

        $this->smhd = new \Flare\Formats\Iso\Boxes\Smhd($this->file);
        $this->minf->addBox($this->smhd);

        $this->dinf = new \Flare\Formats\Iso\Boxes\Dinf($this->file);
        $this->minf->addBox($this->dinf);

        $this->dref = new \Flare\Formats\Iso\Boxes\Dref($this->file);
        $this->dinf->addBox($this->dref);

        $this->url = new \Flare\Formats\Iso\Boxes\Url($this->file);
        $this->dref->addBox($this->url);

        $this->stbl = new \Flare\Formats\Iso\Boxes\Stbl($this->file);
        $this->minf->addBox($this->stbl);

        $this->stsd = new \Flare\Formats\Iso\Boxes\Stsd($this->file);
        $this->stbl->addBox($this->stsd);

        $this->sampleEntry = new \Flare\Formats\Iso\Boxes\SampleEntries\Mp4a($this->file);
        $this->sampleEntry->setSampleRate($this->sampleRate);
        $this->sampleEntry->setDataReferenceIndex(1);
        
        $this->esds = new \Flare\Formats\Iso\Boxes\Esds($this->file);
        $this->sampleEntry->addBox($this->esds);
        
        $this->stsd->addBox($this->sampleEntry);

        $this->stts = new \Flare\Formats\Iso\Boxes\Stts($this->file);
        $this->stbl->addBox($this->stts);

        $this->stsc = new \Flare\Formats\Iso\Boxes\Stsc($this->file);
        $this->stbl->addBox($this->stsc);

        $this->stsz = new \Flare\Formats\Iso\Boxes\Stsz($this->file);
        $this->stbl->addBox($this->stsz);

        $this->stco = new \Flare\Formats\Iso\Boxes\Stco($this->file);
        $this->stbl->addBox($this->stco);
    }

    public function mapFromTrak($trak) {
        $this->trak = $trak;
        $this->boxMap = $trak->getBoxMap();
        $this->dataMap = [];
        $this->sampleToChunkMap = [];
        $this->file = $trak->getFile();
        $this->buildDecodeTable();
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


        $this->chunkOffsetTable = $this->stco->getChunkOffsetTable();
        $this->sampleSizeTable = $this->stsz->getSampleSizeTable();
        $this->sampleCount = $this->stsz->getSampleCount();
        $this->chunkTable = $this->stsc->getChunkTable(); //sampleTableBox
        $this->chunkTableEntryCount = $this->stsc->getChunkTableEntryCount();


        //[index][offset, number of samples, bytes per sample ]  
        for ($i = 0; $i < $this->chunkCount; $i++) {
            $this->dataMap[$i][0] = $this->chunkOffsetTable[$i];
        }
        
        //FULL DATA TABLE
        for ($i = 0; $i < $this->sampleCount; $i++) {
            $this->expandedDataTable[$i][0] = $this->sampleSizeTable[$i]; //bytes per sample
        }

        //Now decode the chunkTable
        //Chunk run table for size = 1 wont work!!
        for ($i = 1; $i < $this->chunkTableEntryCount; $i++) {

            $this->chunkRunTable[$i - 1] = [
                $this->chunkTable[$i][0] - $this->chunkTable[$i - 1][0],
                $this->chunkTable[$i-1][1],
                $this->chunkTable[$i-1][2] 
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
        $tempDelta = 1024;
        
        for ($i = 0; $i < count($this->chunkRunTable); $i++) {
           
            for($n = 0 ;$n < $this->chunkRunTable[$i][0]; $n++){ //each one of these chunks is the same num of samples
                
                
                $offset = $this->chunkOffsetTable[$currentChunk]; //offset to the beginning of each chunk
                
                for($x = 0; $x < $this->chunkRunTable[$i][1]; $x++){
                    $this->expandedDataTable[$currentSample][1] = $offset; // the overall offset
                    $this->expandedDataTable[$currentSample][2] = $i; // the chunk that it belongs to
                    $this->expandedDataTable[$currentSample][3] = $this->chunkRunTable[$i][2]; // desc
                    $this->expandedDataTable[$currentSample][4] = $tempDelta;
                    
                    
                    $offset+= $this->expandedDataTable[$currentSample][0];
                    $currentSample++;
                }
                
                $currentChunk++;
            }
        }
        //var_dump($test);
        //var_dump($this->fullSampleMap);
        
 /*       
        //Now finish building the dataMapping
        $currentIndex = 0;
        $currentSampleIndex = 0;

        for ($n = 0; $n < $this->chunkTableEntryCount; $n++) {
            for ($i = 0; $i < $this->chunkRunTable[$n]; $i++) {
                $this->dataMap[$currentIndex][1] = $this->chunkTable[$n][1];
                $this->dataMap[$currentIndex][2] = 0;
                for ($m = 0; $m < $this->chunkTable[$n][1]; $m++) {
                    $this->dataMap[$currentIndex][2] += $this->sampleSizeTable[$currentSampleIndex];
                    $currentSampleIndex++;
                }

                $currentIndex++;
            }
        }

        //Finally build the table that maps each sample to a chunk for random access of any sample
        for ($i = 0; $i < count($this->dataMap); $i++) {
            for ($n = 0; $n < $this->dataMap[$i][1]; $n++) {
                $this->sampleToChunkMap[] = $i;
            }
        }
 * 
 */
    }

    

    public function getSample($num) {

        if ($num > $this->sampleCount) {
            return; //Throw an exception later here
        }
        fseek($this->file, $this->dataMap[$num][0]);
        return fread($this->file, $this->dataMap[$num][2]);
    }

    //Probably just for testing
    public function setOutputFile($file) {
        $this->outputFile = $file;
    }

    public function getTrak() {
        //
        return $this->trak;
    }

    public function dumpBinary($outputFile) {
         for ($i = 0; $i < count($this->expandedDataTable); $i++) {

            fseek($this->file, $this->expandedDataTable[$i][1]);

            $data = fread($this->file, $this->expandedDataTable[$i][0]);
            fwrite($outputFile, $data);
            
        }
    }
    
    public function readSample(&$sample) {
        fseek($this->file, $this->expandedDataTable[$this->currentSample][1]);
        $sample = fread($this->file, $this->expandedDataTable[$this->currentSample][0]);
        $metaData = $this->expandedDataTable[$this->currentSample]; 
        $this->currentSample++;
        return $metaData;
    }

    public function writeSample($sample, $sampleMeta) {
        $sampleDelta = 1024; //Need to pull this from file eventually
        $this->currentWriteLocation = ftell($this->file); //record the current write location
        if ($this->currentSample > 0) {
            if ($this->currentWriteLocation != $this->consecutiveWriteLocation) {
                $this->currentChunk++;
                $this->chunkOffsetTable[] = $this->currentWriteLocation;
            }
        }else{
            //Record the offset to the first chunk
            $this->chunkOffsetTable[] = $this->currentWriteLocation;
        }
        
        $this->consecutiveWriteLocation = $this->currentWriteLocation + $sampleMeta[0];
        
        $this->duration+= $sampleDelta; //add up the duration
        $this->fullSampleMap[] = [ftell($this->file), $sampleMeta[0], $sampleDelta, $this->currentChunk]; //[offset, bytesPerSample, sampleDelta, chunk]
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
        $this->durationInRealTime = $this->duration / $this->sampleRate * 1000;
        $this->mdhd->setTimeScale($this->sampleRate);
        $this->mdhd->setDuration($this->duration);
        $this->tkhd->setDuration($this->durationInRealTime);
        $this->tkhd->setTrackID($this->trackID);
        $this->tkhd->setAlternateGroup(1); //0 doesn't work for some reason
        
        $segmentTable = array(["segmentDuration" =>  $this->durationInRealTime , "mediaTime" => 0 ]);
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

        if (count($this->fullSampleMap) == 0) {
            return [ 0 => 0];
        }

        $delta = $this->fullSampleMap[0][2];
        $deltaCount = 1;
        for ($i = 1; $i < count($this->fullSampleMap); $i++) {
            if ($delta == $this->fullSampleMap[$i][2]) {
                $deltaCount++;
            } else {
                $this->deltaTable[] = [$deltaCount, $delta];
                $delta = $this->fullSampleMap[$i][2];
                $deltaCount = 1;
            }
        }
        $this->deltaTable[] = [$deltaCount, $delta];
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
    }
    
    
    private function encodeSampleSizeTable() {
        for ($i = 0; $i < count($this->fullSampleMap); $i++) {
            $this->sampleSizeTable[] = $this->fullSampleMap[$i][1];
        }
    }

    public function getDurationInRealTime(){
        return $this->durationInRealTime;
    }
    
    public function setTrackID($ID){
        $this->trackID = $ID;
    }
}
