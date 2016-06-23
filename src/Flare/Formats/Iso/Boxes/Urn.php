<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Urn
 * @author Brian Parra
 */
class Urn extends \Flare\Formats\Iso\FullBox {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::URN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}