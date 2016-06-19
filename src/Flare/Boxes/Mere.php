<?php

namespace Flare\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Mere extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::MERE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}