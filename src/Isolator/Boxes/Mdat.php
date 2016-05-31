<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Mdat extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

    public function displayDetailedBoxMap(){
        
    }

}