<?php

namespace Flare\Boxes;

/**
 * Fire Resevoir
 * @author Brian Parra
 */
class Fire extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::FIRE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}