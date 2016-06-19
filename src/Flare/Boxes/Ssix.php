<?php

namespace Flare\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Ssix extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SSIX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}