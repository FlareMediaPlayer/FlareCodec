<?php

namespace Flare\Boxes;

/**
 * Track Reference Container
 * @author Brian Parra
 */
class Tref extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}