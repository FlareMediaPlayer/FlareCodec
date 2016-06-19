<?php

namespace Flare\Boxes;

/**
 * Segment Index Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Sidx extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SIDX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}