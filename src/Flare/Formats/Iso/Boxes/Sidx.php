<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Segment Index Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Sidx extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SIDX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}