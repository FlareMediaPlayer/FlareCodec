<?php

namespace Isolator\Boxes;

/**
 * Subtitle Media Header
 * @author Brian Parra
 */
class Sthd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}