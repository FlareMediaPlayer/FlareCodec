<?php

namespace Isolator\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fecr extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FECR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}