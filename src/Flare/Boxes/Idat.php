<?php

namespace Flare\Boxes;

/**
 * Item Data
 * @author Brian Parra
 */
class Idat extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::IDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}