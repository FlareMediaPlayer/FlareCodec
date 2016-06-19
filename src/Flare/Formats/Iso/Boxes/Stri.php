<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Extended Language Tag
 * @author Brian Parra
 */
class Stri extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STRI;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}