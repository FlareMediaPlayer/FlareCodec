<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample to group
 * @author Brian Parra
 */
class Sbgp extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SBGP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}