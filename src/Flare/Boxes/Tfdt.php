<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Tfdt extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TFDT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}