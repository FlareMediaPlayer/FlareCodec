<?php

namespace Flare\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Iinf extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::IINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}