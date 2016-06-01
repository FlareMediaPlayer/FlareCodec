<?php

namespace Isolator\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Elng extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::ELNG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}