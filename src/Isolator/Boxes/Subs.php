<?php

namespace Isolator\Boxes;

/**
 * Sub-Sample Information
 * @author Brian Parra
 */
class Subs extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SUBS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}