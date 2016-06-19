<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Track Reference Container
 * @author Brian Parra
 */
class Tref extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}