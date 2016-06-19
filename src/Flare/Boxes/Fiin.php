<?php

namespace Flare\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Fiin extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::FIIN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}