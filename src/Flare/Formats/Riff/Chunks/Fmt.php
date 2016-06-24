<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Formats\Riff\Chunks;

/**
 * This is the format sub chunk
 *
 * @author Brian Parra
 */
class Fmt extends \Flare\Formats\Riff\Chunk{
    
    private $audioFormat;
    private $numChannels;
    private $sampleRate;
    private $byteRate;//SampleRate * NumChannels * BitsPerSample/8
    private $blockAlign;
    private $bitsPerSample; //8, 16 ect
    

    public function __construct($dwFourCC, $file) {
        parent::__construct($dwFourCC, $file);
        
    }
    
    public function loadData() {
        $this->audioFormat = \Flare\Common\ByteUtils::readUnsignedShortLE($this->file);
        $this->numChannels = \Flare\Common\ByteUtils::readUnsignedShortLE($this->file);
        $this->sampleRate = \Flare\Common\ByteUtils::readUnsingedIntegerLE($this->file);
        $this->byteRate = \Flare\Common\ByteUtils::readUnsingedIntegerLE($this->file);
        $this->blockAlign = \Flare\Common\ByteUtils::readUnsignedShortLE($this->file);
        $this->bitsPerSample = \Flare\Common\ByteUtils::readUnsignedShortLE($this->file);
    }
    
    public function getDetails(){
        $details = [];
        $details["code"] = $this->dwFourCC;
        $details["offset"] = $this->offset;
        $details["chunkSize"] = $this->dwChunkSize;
        $details["audioFormat"] = $this->audioFormat;
        $details["numChannels"] = $this->numChannels;
        $details["sampleRate"] = $this->sampleRate;
        $details["byteRate"] = $this->byteRate;
        $details["blockAlign"] = $this->blockAlign;
        $details["bitsPerSample"] = $this->bitsPerSample;
        return $details;
    }
}
