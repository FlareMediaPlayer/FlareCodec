<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Sample to Group Description
 * @author Brian Parra
 */
class Sgpd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SGPD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}