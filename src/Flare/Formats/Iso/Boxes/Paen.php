<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Partition Entry
 * @author Brian Parra
 */
class Paen extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::PAEN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}