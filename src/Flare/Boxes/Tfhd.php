<?php

namespace Flare\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Tfhd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}