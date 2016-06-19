<?php

namespace Flare\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Mehd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MEHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}