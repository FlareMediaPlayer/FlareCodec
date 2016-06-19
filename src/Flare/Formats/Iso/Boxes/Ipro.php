<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Ipro extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::IPRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}