<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Item Location
 * @author Brian Parra
 */
class Iloc extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::ILOC;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}