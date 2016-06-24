<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Formats\Riff;

/**
 * Description of Chunk
 *
 * @author Brian Parra
 */
 abstract class Chunk {
    protected $file;
    protected $dwFourCC;
    protected $offset;
    protected $dwChunkSize;
    
    function __construct($dwFourCC, $file){
        $this->dwFourCC = $dwFourCC;
        $this->file = $file;
        $this->offset = ftell($this->file) - 4;
        $this->dwChunkSize = \Flare\Common\ByteUtils::readUnsingedIntegerLE($this->file);
    }
    
    public function getFourCC(){
        return $this->dwFourCC;
    }
    
    abstract function loadData();
    
    public static function CreateChunk($dwFourCC, $file){
        $class = "\\Flare\\Formats\\Riff\\Chunks\\" .   $dwFourCC;
        return new $class($dwFourCC, $file);
    }
}

