<?php

namespace Flare\Boxes;

/**
 * Holds Meta Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Meco extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MECO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}