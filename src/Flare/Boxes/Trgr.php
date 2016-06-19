<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Trgr extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TRGR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}