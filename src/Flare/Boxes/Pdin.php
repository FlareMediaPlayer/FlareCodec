<?php

namespace Flare\Boxes;

/**
 * Progressive Download Information Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Pdin extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::PDIN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}