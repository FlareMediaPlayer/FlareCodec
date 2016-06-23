<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Composition to decode timeline mapping
 * @author Brian Parra
 */
class Cslg extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::CSLG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}