<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Segr extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SEGR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}