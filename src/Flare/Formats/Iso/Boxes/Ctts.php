<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Ctts extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::CTTS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}