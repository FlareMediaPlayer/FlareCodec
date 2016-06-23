<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Fragment Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Moof extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MOOF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}