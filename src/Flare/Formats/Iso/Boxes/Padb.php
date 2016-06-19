<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample Padding Bits
 * @author Brian Parra
 */
class Padb extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::PADB;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}