<?php

namespace Isolator\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fpar extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FPAR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}