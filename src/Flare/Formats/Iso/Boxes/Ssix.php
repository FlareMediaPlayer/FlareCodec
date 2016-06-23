<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Ssix extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SSIX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}