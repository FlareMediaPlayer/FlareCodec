<?php

namespace Isolator\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Frma extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FRMA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}