<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Mehd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MEHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}