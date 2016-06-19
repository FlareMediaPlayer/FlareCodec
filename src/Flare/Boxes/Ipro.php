<?php

namespace Flare\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Ipro extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::IPRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}