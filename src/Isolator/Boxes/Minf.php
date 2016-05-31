<?php

namespace Isolator\Boxes;

/**
 * Description of Minf
 *
 * @author Brian Parra
 */
class Minf extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}