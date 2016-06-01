<?php

namespace Isolator\Boxes;

/**
 * XML Container
 * @author Brian Parra
 */
class Xml extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::XML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}