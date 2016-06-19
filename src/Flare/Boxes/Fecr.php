<?php

namespace Flare\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fecr extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::FECR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}