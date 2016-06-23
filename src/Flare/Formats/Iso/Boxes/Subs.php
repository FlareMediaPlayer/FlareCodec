<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sub-Sample Information
 * @author Brian Parra
 */
class Subs extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SUBS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}