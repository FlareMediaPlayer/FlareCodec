<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Item Data
 * @author Brian Parra
 */
class Idat extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::IDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}