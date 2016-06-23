<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Shadow Sync Sample Table
 * @author Brian Parra
 */
class Stsh extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STSH;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}