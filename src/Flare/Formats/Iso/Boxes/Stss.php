<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sync Sample Table
 * @author Brian Parra
 */
class Stss extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STSS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}