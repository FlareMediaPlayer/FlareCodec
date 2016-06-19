<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Strk extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STRK;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}