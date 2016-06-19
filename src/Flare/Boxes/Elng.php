<?php

namespace Flare\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Elng extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::ELNG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}