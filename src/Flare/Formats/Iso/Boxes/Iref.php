<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Iref extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::IREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}