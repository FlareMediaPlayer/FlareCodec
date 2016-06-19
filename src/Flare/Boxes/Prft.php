<?php

namespace Flare\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Prft extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::PRFT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}