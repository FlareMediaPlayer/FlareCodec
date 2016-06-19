<?php

namespace Flare\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Ctts extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::CTTS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}