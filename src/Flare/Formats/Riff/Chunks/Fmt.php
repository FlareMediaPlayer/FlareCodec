<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Formats\Riff\Chunks;

/**
 * Description of Fmt
 *
 * @author Brian Parra
 */
class Fmt extends \Flare\Formats\Riff\Chunk{
    
    public function loadData() {
        ;
    }
    public function getDetails(){
        $details = [];
        $details["code"] = $this->dwFourCC;
        $details["offset"] = $this->offset;
        $details["chunkSize"] = $this->dwChunkSize;
        $details["format"] = $this->format;
        return $details;
    }
}
