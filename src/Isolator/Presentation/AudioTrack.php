<?php

/**
 * Description of AudioTrack
 *
 * @author Brian Parra
 */

namespace Isolator\Presentation;

class AudioTrack extends \Isolator\Presentation\Track {

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

    public function __construct($movie) {

        $this->fullSampleMap = [];
        $this->deltaTable = [];
        
        $this->movie = $movie;
        $this->file = $this->movie->getFile();
        //We have to build an entire trak, then copy details over if available
        //For now this one is an audio track

        $this->trak = new \Isolator\Boxes\Trak($this->file);
        

        $this->tkhd = new \Isolator\Boxes\Tkhd($this->file);
        $this->trak->addBox($this->tkhd);

        $this->mdia = new \Isolator\Boxes\Mdia($this->file);
        $this->trak->addBox($this->mdia);

        $this->mdhd = new \Isolator\Boxes\Mdhd($this->file);
        $this->mdia->addBox($this->mdhd);

        $this->hdlr = new \Isolator\Boxes\Hdlr($this->file);
        $this->mdia->addBox($this->hdlr);

        $this->minf = new \Isolator\Boxes\Minf($this->file);
        $this->mdia->addBox($this->minf);

        $this->smhd = new \Isolator\Boxes\Smhd($this->file);
        $this->minf->addBox($this->smhd);

        $this->dinf = new \Isolator\Boxes\Dinf($this->file);
        $this->minf->addBox($this->dinf);

        $this->dref = new \Isolator\Boxes\Dref($this->file);
        $this->dinf->addBox($this->dref);

        $this->url = new \Isolator\Boxes\Url($this->file);
        $this->dref->addBox($this->url);

        $this->stbl = new \Isolator\Boxes\Stbl($this->file);
        $this->minf->addBox($this->stbl);

        $this->stsd = new \Isolator\Boxes\Stsd($this->file);
        $this->stbl->addBox($this->stsd);

        $this->sampleEntry = new \Isolator\Boxes\SampleEntries\Mp4a($this->file);
        $this->stsd->addBox($this->sampleEntry);

        $this->stts = new \Isolator\Boxes\Stts($this->file);
        $this->stbl->addBox($this->stts);

        $this->stsc = new \Isolator\Boxes\Stsc($this->file);
        $this->stbl->addBox($this->stsc);

        $this->stsz = new \Isolator\Boxes\Stsz($this->file);
        $this->stbl->addBox($this->stsz);

        $this->stco = new \Isolator\Boxes\Stco($this->file);
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


        $this->tkhd = $this->trak->getBoxByClass('\Isolator\Boxes\Tkhd');
        $this->mdia = $this->trak->getBoxByClass('\Isolator\Boxes\Mdia');
        $this->mdhd = $this->mdia->getBoxByClass('\Isolator\Boxes\Mdhd');
        $this->hdlr = $this->mdia->getBoxByClass('\Isolator\Boxes\Hdlr');
        $this->minf = $this->mdia->getBoxByClass('\Isolator\Boxes\Minf');
        $this->stbl = $this->minf->getBoxByClass('\Isolator\Boxes\Stbl');


        $this->stts = $this->stbl->getBoxByClass('\Isolator\Boxes\Stts');
        $this->stsc = $this->stbl->getBoxByClass('\Isolator\Boxes\Stsc');
        $this->stsz = $this->stbl->getBoxByClass('\Isolator\Boxes\Stsz');
        $this->stco = $this->stbl->getBoxByClass('\Isolator\Boxes\Stco');
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


        //Now decode the chunkTable
        for ($i = 1; $i < $this->chunkTableEntryCount; $i++) {

            $this->chunkRunTable[$i - 1] = $this->chunkTable[$i][0] - $this->chunkTable[$i - 1][0];
        }

        $this->chunkRunTable[] = $this->chunkCount - $this->chunkTable[$this->chunkTableEntryCount - 1][0];


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
        for($i = 0; $i < count($this->dataMap); $i++){
            for($n = 0; $n < $this->dataMap[$i][1] ; $n++){
                $this->sampleToChunkMap[] = $i;
            }
        }
    }

    public function dumpBinary($outputFile) {
        //Lets Try Dumping raw binary to file
        for ($i = 0; $i < count($this->dataMap); $i++) {

            fseek($this->file, $this->dataMap[$i][0]);

            $data = fread($this->file, $this->dataMap[$i][2]);
            fwrite($outputFile, $data);
        }
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
    
    public function readSample(&$sample) {
        $chunk = $this->sampleToChunkMap[$this->currentSample]; //Find which chunk it belongs to
        fseek($this->file, $this->dataMap[$chunk][0]);
        $sample = fread($this->file, $this->dataMap[$chunk][2]);
        
        $this->currentSample++;
        return $this->dataMap[$chunk];
        
    }

    public function writeSample($sample, $sampleMeta){
        $this->fullSampleMap[] = [ftell($this->file) , $sampleMeta[2] , 1024]; //[offset, bytesPerSample, sampleDelta]
        fwrite($this->file, $sample);
        
    }
    
    public function setCurrentSample($currentSample){
        $this->currentSample = $currentSample;
    }

    public function getSampleCount(){
        return $this->sampleCount;
    }
    
    public function finalize(){
        $this->encodeDeltaTable();
  
        //we first have to encode the 4 tables, stts, stsc, stsz, stco
        $this->stts->setDeltaTable($this->deltaTable);
    }
    
    private function encodeDeltaTable(){
        
        if (count($this->fullSampleMap) == 0){
            return [ 0 => 0];
        }
        
        $delta = $this->fullSampleMap[0][2];
        $deltaCount = 1;
        for($i = 1; $i < count($this->fullSampleMap); $i++){
            if($delta == $this->fullSampleMap[$i][2]){
                $deltaCount++;
            }else{
                $this->deltaTable[] = [$deltaCount , $delta];
                $delta = $this->fullSampleMap[$i][2];
                $deltaCount = 1;
            }
        }
        $this->deltaTable[] = [$deltaCount , $delta];
    }
}
