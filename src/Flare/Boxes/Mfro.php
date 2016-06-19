<?php

namespace Flare\Boxes;

/**
 * Movie Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Mfro extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MFRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}