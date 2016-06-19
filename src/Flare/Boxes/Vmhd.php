<?php

namespace Flare\Boxes;

/**
 * Video Media Header
 * @author Brian Parra
 */
class Vmhd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::VMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}