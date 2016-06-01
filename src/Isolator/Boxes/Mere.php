<?php

namespace Isolator\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Mere extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MERE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}