<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Tfhd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}