<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Copyright info
 * @author Brian Parra
 */
class Cprt extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::CPRT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}