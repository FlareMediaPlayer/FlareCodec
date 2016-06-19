<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Subtitle Media Header
 * @author Brian Parra
 */
class Sthd extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}