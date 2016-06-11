<?php

/**
 * Description of AudioTrack
 *
 * @author Brian Parra
 */

namespace Isolator\Presentation;

class AudioTrack extends \Isolator\Presentation\Track {

    //put your code here
    private $trak;
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

    public function __construct($trak) {
        $this->trak = $trak;
        $this->boxMap = $trak->getBoxMap();
        $this->dataMap = [];
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
    }

    public function dumpBinary($outputFile) {
        //Lets Try Dumping raw binary to file
        for ($i = 0; $i < count($this->dataMap); $i++) {

            fseek($this->file, $this->dataMap[$i][0]);

            $data = fread($this->file, $this->dataMap[$i][2]);
            fwrite($outputFile, $data);
        }
    }
    
    public function getSample($num){
        
        if($num > $this->sampleCount){
            return; //Throw an exception later here
        }
        fseek($this->file, $this->dataMap[$num][0]);
        return fread($this->file, $this->dataMap[$num][2]);
            
    }

    //Probably just for testing
    public function setOutputFile($file) {
        $this->outputFile = $file;
    }

}
