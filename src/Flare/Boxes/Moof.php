<?php

namespace Flare\Boxes;

/**
 * Movie Fragment Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Moof extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MOOF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}