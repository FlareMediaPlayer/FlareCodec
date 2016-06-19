<?php

namespace Flare\Boxes;

/**
 * File Partition
 * @author Brian Parra
 */
class Fpar extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::FPAR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}