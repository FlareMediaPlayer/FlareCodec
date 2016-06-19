<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Scheme Information Box
 * @author Brian Parra
 */
class Schi extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SCHI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}