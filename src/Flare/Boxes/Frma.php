<?php

namespace Flare\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Frma extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::FRMA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}