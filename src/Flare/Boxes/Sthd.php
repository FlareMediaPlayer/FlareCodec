<?php

namespace Flare\Boxes;

/**
 * Subtitle Media Header
 * @author Brian Parra
 */
class Sthd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}