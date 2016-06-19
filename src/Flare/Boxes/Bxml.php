<?php

namespace Flare\Boxes;

/**
 * Binary XML
 * @author Brian Parra
 */
class Bxml extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::BXML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}