<?php

namespace Isolator\Boxes;

/**
 * Url
 * @author Brian Parra
 */
class Url extends \Isolator\FullBox {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::URL;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}