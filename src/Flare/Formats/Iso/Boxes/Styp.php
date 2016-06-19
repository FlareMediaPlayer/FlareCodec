<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Styp extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STYP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}