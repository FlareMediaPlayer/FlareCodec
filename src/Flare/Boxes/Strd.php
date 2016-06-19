<?php

namespace Flare\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Strd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STRD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}