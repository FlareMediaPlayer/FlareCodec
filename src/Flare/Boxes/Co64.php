<?php

namespace Flare\Boxes;

/**
 * 64-bit chunk offset
 * @author Brian Parra
 */
class Co64 extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::CO64;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}