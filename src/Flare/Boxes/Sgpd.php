<?php

namespace Flare\Boxes;

/**
 * Sample to Group Description
 * @author Brian Parra
 */
class Sgpd extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SGPD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}