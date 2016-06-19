<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * User-data
 * Is a top level box.
 * @author Brian Parra
 */
class Udta extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::UDTA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}