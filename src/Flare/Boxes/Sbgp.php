<?php

namespace Flare\Boxes;

/**
 * Sample to group
 * @author Brian Parra
 */
class Sbgp extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SBGP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}