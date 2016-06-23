<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Progressive Download Information Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Pdin extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::PDIN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}