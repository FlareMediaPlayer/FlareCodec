<?php

namespace Flare\Boxes;

/**
 * Urn
 * @author Brian Parra
 */
class Urn extends \Flare\FullBox {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::URN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}