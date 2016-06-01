<?php

namespace Isolator\Boxes;

/**
 * Hint Media Header
 * @author Brian Parra
 */
class Hmhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::HMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}