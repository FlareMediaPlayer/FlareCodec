<?php

namespace Flare\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Styp extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STYP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}