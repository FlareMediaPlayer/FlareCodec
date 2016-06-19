<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Stz2 extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STZ2;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}