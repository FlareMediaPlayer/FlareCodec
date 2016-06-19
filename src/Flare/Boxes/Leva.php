<?php

namespace Flare\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Leva extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}