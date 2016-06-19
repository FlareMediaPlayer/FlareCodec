<?php

namespace Flare\Boxes;

/**
 * Composition to decode timeline mapping
 * @author Brian Parra
 */
class Cslg extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::CSLG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}