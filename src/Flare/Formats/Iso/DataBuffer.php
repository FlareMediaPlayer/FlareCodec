<?php

namespace Flare\Formats\Iso;

/**
 * Description of DataBuffer
 *
 * @author Brian Parra
 */
class DataBuffer {
    
    private $inputTrack;
    private $outputTrack;
    private $sample;
    private $sampleMeta;
    
    public function __construct() {
        //check buffer sizes here later
        
    }
    
    public function setInputTrack($inputTrack){
        $this->inputTrack = $inputTrack;
    }

    public function setOutputTrack($outputTrack){
       $this->outputTrack = $outputTrack; 
    }

    public function readSample(){
        
        $this->sampleMeta = $this->inputTrack->readSample($this->sample);
        
    }
    
    public function writeSample(){
        //For this we need a byteCount, and sampleDelta
        $this->outputTrack->writeSample($this->sample, $this->sampleMeta);
    }
    
}
