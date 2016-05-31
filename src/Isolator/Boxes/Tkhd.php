<?php

namespace Isolator\Boxes;

/**
 * Description of Tkhd
 *
 * @author Brian Parra
 */
class Tkhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TKHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}