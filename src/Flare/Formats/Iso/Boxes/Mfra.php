<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Fragment Random Access box.
 * Is a top level box.
 * @author Brian Parra
 */
class Mfra extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}