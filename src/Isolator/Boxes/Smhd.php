<?php

namespace Isolator\Boxes;

/**
 * Description of Smhd
 *
 * @author Brian Parra
 */
class Smhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}