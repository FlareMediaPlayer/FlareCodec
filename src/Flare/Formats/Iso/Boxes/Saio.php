<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample Auxiliary Information Offsets
 * @author Brian Parra
 */
class Saio extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SAIO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}