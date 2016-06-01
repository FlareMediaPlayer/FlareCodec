<?php

namespace Isolator\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Iinf extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::IINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}