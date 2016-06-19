<?php

namespace Flare\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Tsel extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::TSEL;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}