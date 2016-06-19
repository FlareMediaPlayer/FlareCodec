<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Mfro extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MFRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}