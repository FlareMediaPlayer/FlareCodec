<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Track Fragment.
 * Is a top level box.
 * @author Brian Parra
 */
class Traf extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TRAF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}