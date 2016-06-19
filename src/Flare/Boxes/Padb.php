<?php

namespace Flare\Boxes;

/**
 * Sample Padding Bits
 * @author Brian Parra
 */
class Padb extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::PADB;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}