<?php

namespace Flare\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Stri extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STRI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}