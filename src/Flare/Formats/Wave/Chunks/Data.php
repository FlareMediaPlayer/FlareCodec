<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Formats\Wave\Chunks;

/**
 * Description of Data
 *
 * @author Brian Parra
 */
class Data extends \Flare\Formats\Riff\Chunk {
    
    
    
    public function __construct( $file) {
        parent::__construct("data", $file);
        
    }
    
    public function loadData() {
        ;
    }
    
    public function getDetails(){
        $details = [];
        $details["code"] = $this->dwFourCC;
        $details["offset"] = $this->offset;
        $details["chunkSize"] = $this->dwChunkSize;
        return $details;
    }
}

