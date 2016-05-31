<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Free extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FREE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

    public function displayDetailedBoxMap(){
        
    }

}
