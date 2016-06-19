<?php

namespace Flare\Boxes;

/**
 * Hint Media Header
 * @author Brian Parra
 */
class Hmhd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::HMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}