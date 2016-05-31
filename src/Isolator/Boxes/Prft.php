<?php

namespace Isolator\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Prft extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::PRFT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}