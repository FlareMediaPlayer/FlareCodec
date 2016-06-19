<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Trun extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::TRUN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}