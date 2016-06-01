<?php

namespace Isolator\Boxes;

/**
 * Scheme Information Box
 * @author Brian Parra
 */
class Schi extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SCHI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}