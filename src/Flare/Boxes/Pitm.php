<?php

namespace Flare\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Pitm extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::PITM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}