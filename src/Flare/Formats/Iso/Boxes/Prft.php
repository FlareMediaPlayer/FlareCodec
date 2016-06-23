<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Holds Segment Type Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Prft extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::PRFT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}