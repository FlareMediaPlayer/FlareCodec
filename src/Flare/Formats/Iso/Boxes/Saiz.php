<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample Auxillary Information Sizes
 * @author Brian Parra
 */
class Saiz extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}