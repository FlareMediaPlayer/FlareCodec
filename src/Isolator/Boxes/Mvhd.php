<?php

namespace Isolator\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Mvhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MVHD;
        parent::__construct($file);
  
        
    }
    
    public function loadData() {
        
    }

    public function displayDetailedBoxMap(){
        
    }

}