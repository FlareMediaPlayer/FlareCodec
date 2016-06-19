<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Leva extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}