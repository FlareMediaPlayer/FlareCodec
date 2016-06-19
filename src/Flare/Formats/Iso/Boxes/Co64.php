<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * 64-bit chunk offset
 * @author Brian Parra
 */
class Co64 extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::CO64;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}