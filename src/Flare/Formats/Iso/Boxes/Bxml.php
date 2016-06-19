<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Binary XML
 * @author Brian Parra
 */
class Bxml extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::BXML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}