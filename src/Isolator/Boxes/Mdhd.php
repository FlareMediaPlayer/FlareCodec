<?php

namespace Isolator\Boxes;

/**
 * Description of Mhd
 *
 * @author Brian Parra
 */
class Mdhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MDHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}