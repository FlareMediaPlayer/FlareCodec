<?php

namespace Flare\Boxes;

/**
 * User-data
 * Is a top level box.
 * @author Brian Parra
 */
class Udta extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::UDTA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}