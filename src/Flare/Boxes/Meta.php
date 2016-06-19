<?php

namespace Flare\Boxes;

/**
 * Holds Meta Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Meta extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::META;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}