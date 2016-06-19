<?php

namespace Flare\Boxes;

/**
 * Movie Extends Box
 * Is a top level box.
 * @author Brian Parra
 */
class Mvex extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MVEX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}