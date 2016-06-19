<?php

namespace Flare\Boxes;

/**
 * Null Media Header
 * @author Brian Parra
 */
class Nmhd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::NMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}