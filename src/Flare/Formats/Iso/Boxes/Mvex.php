<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Movie Extends Box
 * Is a top level box.
 * @author Brian Parra
 */
class Mvex extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MVEX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}