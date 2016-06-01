<?php

namespace Isolator\Boxes;

/**
 * Video Media Header
 * @author Brian Parra
 */
class Vmhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::VMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}