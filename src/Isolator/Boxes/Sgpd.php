<?php

namespace Isolator\Boxes;

/**
 * Sample to Group Description
 * @author Brian Parra
 */
class Sgpd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SGPD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}