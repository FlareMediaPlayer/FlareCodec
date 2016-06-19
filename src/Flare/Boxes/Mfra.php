<?php

namespace Flare\Boxes;

/**
 * Movie Fragment Random Access box.
 * Is a top level box.
 * @author Brian Parra
 */
class Mfra extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}