<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Pitm extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::PITM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}