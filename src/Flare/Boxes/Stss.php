<?php

namespace Flare\Boxes;

/**
 * Sync Sample Table
 * @author Brian Parra
 */
class Stss extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STSS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}