<?php

namespace Flare\Boxes;

/**
 * Sample Auxiliary Information Offsets
 * @author Brian Parra
 */
class Saio extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SAIO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}