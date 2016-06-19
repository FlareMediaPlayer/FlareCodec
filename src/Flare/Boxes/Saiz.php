<?php

namespace Flare\Boxes;

/**
 * Sample Auxillary Information Sizes
 * @author Brian Parra
 */
class Saiz extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}