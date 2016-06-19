<?php

namespace Flare\Boxes;

/**
 * Movie Fragment Header
 * Is a top level box.
 * @author Brian Parra
 */
class Mfhd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}