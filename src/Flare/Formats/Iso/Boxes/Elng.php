<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Elng extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::ELNG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}