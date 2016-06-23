<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample Degradation Priority
 * @author Brian Parra
 */
class Stdp extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STDP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}