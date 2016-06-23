<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Tsel extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TSEL;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}