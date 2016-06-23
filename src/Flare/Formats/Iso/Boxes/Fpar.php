<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fpar extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::FPAR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}