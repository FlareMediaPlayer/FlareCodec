<?php

namespace Flare\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Stz2 extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STZ2;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}