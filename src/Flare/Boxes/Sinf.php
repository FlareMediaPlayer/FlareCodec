<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Sinf extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}