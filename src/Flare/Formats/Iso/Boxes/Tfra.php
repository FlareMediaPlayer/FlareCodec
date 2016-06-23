<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Track Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Tfra extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}