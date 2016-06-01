<?php

namespace Isolator\Boxes;

/**
 * Item Location
 * @author Brian Parra
 */
class Iloc extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::ILOC;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}