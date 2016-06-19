<?php

namespace Flare\Boxes;

/**
 * Scheme Type Box
 * @author Brian Parra
 */
class Schm extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SCHM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}
