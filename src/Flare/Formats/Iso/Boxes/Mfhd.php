<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Fragment Header
 * Is a top level box.
 * @author Brian Parra
 */
class Mfhd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}