<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Sinf extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}