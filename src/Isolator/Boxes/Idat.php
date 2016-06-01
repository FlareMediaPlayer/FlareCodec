<?php

namespace Isolator\Boxes;

/**
 * Item Data
 * @author Brian Parra
 */
class Idat extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::IDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}