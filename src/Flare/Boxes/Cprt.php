<?php

namespace Flare\Boxes;

/**
 * Copyright info
 * @author Brian Parra
 */
class Cprt extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::CPRT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}