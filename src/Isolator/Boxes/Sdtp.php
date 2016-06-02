<?php

namespace Isolator\Boxes;

/**
 * Independent and Disposable Samples
 * @author Brian Parra
 */
class Sdtp extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SDTP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}