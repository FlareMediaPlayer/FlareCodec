<?php

namespace Flare\Boxes;

/**
 * Shadow Sync Sample Table
 * @author Brian Parra
 */
class Stsh extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STSH;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}