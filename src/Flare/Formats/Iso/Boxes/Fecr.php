<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fecr extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::FECR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}