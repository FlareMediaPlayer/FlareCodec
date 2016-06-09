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
    private $dataMap;
    
    private $outputFile; //For Testing ???
    

    public function __construct($trak) {
        $this->trak = $trak;
        $this->boxMap = $trak->getBoxMap();
        $this->dataMap = [];
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
        $this->chunkTable = $this->stsc->getChunkTable();


        //[index][offset, number of samples, byte size ]  
        for ($i = 0; $i < $this->chunkCount; $i++) {
            $this->dataMap[$i][0] = $this->chunkOffsetTable[$i];
        }
        
        //Now decode the chunkTable
        for ($i = 1; $i < count($this->chunkTable); $i++) {
            
                $this->chunkRunTable[$i-1] = $this->chunkTable[$i][0] - $this->chunkTable[$i-1][0];
            
        }
        $this->chunkRunTable[] = $this->chunkCount - $this->chunkTable[count($this->chunkTable)-1][0]; 
        //chunkRuns[stscEntryCount-1] = stcoChunkCount- sampleTableBox[stscEntryCount-1][0];
        
        
        
        //Now finish building the dataMapping
        $currentIndex = 0;
        $currentSampleIndex = 0;
        for ($n = 0; $n < count($this->chunkTable); $n++) {
            for ($i = 0; $i < count($this->chunkRunTable[$n]); $i++) {
                $this->dataMap[$currentIndex][1] = $this->chunkTable[$n][1];
                $this->dataMap[$currentIndex][2] = 0;
                for ($m = 0; $m < count($this->chunkTable[$n][1]); $m++) {
                    $this->dataMap[$currentIndex][2] += $this->sampleSizeTable[$currentSampleIndex];
                    $currentSampleIndex++;
                }
                $currentIndex++;
            }
        }


        
        
        //Lets Try Dumping raw binary to file
        //for ($i = 0; $i < count($this->dataMap); $i++) {
                //[n][0] offset
                //[n][2] byte count
                //fwrite($this->trak->getFile(), $this->dataMap[$i][0] , $this->dataMap[$i][2]);
                //\Isolator\ByteUtils::writeBinary($this->outputFile, $this->trak->getFile(), $this->dataMap[$i][0], $this->dataMap[$i][2]);
                //fop.write(fullData, totalData[n][0] , totalData[n][2]);
                //byteStreamBuilder.write(fullData, totalData[n][0] , totalData[n][2]);
           
            //}

    }
    
    //Probably just for testing
    public function setOutputFile($file){
        $this->outputFile = $file;
    }

}
