<?php

namespace Flare\Boxes;

/**
 * Partition Entry
 * @author Brian Parra
 */
class Paen extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::PAEN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}