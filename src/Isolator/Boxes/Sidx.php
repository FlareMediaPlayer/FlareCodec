<?php

namespace Isolator\Boxes;

/**
 * Segment Index Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Sidx extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SIDX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}