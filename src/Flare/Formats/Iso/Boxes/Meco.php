<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Holds Meta Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Meco extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::MECO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}