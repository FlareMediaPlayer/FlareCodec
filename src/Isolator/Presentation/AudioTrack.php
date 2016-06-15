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
    private $chunkCount;
    private $chunkOffsetTable;
    private $sampleSizeTable;
    private $chunkTable;
    private $chunkRunTable;
    private $sampleCount;
    private $dataMap;
    private $sampleToChunkMap;
    private $currentSample = 0;

    public function __construct($movie) {

        $this->movie = $movie;
        $this->file = $this->movie->getFile();
        //We have to build an entire trak, then copy details over if available
        //For now this one is an audio track

        $this->trak = new \Isolator\Boxes\Trak($this->file);
        

        $tkhd = new \Isolator\Boxes\Tkhd($this->file);
        $this->trak->addBox($tkhd);

        $mdia = new \Isolator\Boxes\Mdia($this->file);
        $this->trak->addBox($mdia);

        $mdhd = new \Isolator\Boxes\Mdhd($this->file);
        $mdia->addBox($mdhd);

        $hdlr = new \Isolator\Boxes\Hdlr($this->file);
        $mdia->addBox($hdlr);

        $minf = new \Isolator\Boxes\Minf($this->file);
        $mdia->addBox($minf);

        $smhd = new \Isolator\Boxes\Smhd($this->file);
        $minf->addBox($smhd);

        $dinf = new \Isolator\Boxes\Dinf($this->file);
        $minf->addBox($dinf);

        $dref = new \Isolator\Boxes\Dref($this->file);
        $dinf->addBox($dref);

        $url = new \Isolator\Boxes\Url($this->file);
        $dref->addBox($url);

        $stbl = new \Isolator\Boxes\Stbl($this->file);
        $minf->addBox($stbl);

        $stsd = new \Isolator\Boxes\Stsd($this->file);
        $stbl->addBox($stsd);

        $sampleEntry = new \Isolator\Boxes\SampleEntries\Mp4a($this->file);
        $stsd->addBox($sampleEntry);

        $stts = new \Isolator\Boxes\Stts($this->file);
        $stbl->addBox($stts);

        $stsc = new \Isolator\Boxes\Stsc($this->file);
        $stbl->addBox($stsc);

        $stsz = new \Isolator\Boxes\Stsz($this->file);
        $stbl->addBox($stsz);

        $stco = new \Isolator\Boxes\Stco($this->file);
        $stbl->addBox($stco);
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
        
    }
    
    public function setCurrentSample($currentSample){
        $this->currentSample = $currentSample;
    }

    public function getSampleCount(){
        return $this->sampleCount;
    }
}
