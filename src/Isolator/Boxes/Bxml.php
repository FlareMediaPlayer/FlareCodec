<?php

namespace Isolator\Boxes;

/**
 * Binary XML
 * @author Brian Parra
 */
class Bxml extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::BXML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}