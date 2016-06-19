<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Scheme Type Box
 * @author Brian Parra
 */
class Schm extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SCHM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}
