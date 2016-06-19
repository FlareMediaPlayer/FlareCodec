<?php

namespace Flare\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Trun extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TRUN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}