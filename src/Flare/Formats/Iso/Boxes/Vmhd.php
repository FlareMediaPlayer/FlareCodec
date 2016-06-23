<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Video Media Header
 * @author Brian Parra
 */
class Vmhd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::VMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}