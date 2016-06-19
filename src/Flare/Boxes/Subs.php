<?php

namespace Flare\Boxes;

/**
 * Sub-Sample Information
 * @author Brian Parra
 */
class Subs extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SUBS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}