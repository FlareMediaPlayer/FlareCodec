<?php

namespace Flare\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Iref extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::IREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}