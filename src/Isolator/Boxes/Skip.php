<?php

namespace Isolator\Boxes;

/**
 * Skip box, free space.
 * Is a top level box.
 * @author Brian Parra
 */
class Skip extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SKIP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}