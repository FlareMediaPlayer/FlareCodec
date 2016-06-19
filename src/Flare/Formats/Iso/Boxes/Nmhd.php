<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Null Media Header
 * @author Brian Parra
 */
class Nmhd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::NMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}