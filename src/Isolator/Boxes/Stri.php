<?php

namespace Isolator\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Stri extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STRI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}