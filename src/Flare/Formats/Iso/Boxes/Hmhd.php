<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Hint Media Header
 * @author Brian Parra
 */
class Hmhd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::HMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}