<?php

namespace Flare\Boxes;

/**
 * Scheme Information Box
 * @author Brian Parra
 */
class Schi extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SCHI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}