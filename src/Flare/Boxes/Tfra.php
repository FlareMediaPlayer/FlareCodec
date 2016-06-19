<?php

namespace Flare\Boxes;

/**
 * Track Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Tfra extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}