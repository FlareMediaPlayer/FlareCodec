<?php

namespace Isolator\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Ipro extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::IPRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}