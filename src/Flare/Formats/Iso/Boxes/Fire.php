<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Fire Resevoir
 * @author Brian Parra
 */
class Fire extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::FIRE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}