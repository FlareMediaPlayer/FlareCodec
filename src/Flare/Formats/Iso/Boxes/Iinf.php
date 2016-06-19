<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Item Protection
 * @author Brian Parra
 */
class Iinf extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::IINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}