<?php

namespace Isolator\Boxes;

/**
 * Group Id To Name
 * @author Brian Parra
 */
class Gitn extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::GITN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}