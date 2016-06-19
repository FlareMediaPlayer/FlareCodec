<?php

namespace Flare\Boxes;

/**
 * Track Fragment.
 * Is a top level box.
 * @author Brian Parra
 */
class Traf extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TRAF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}