<?php

namespace Flare\Boxes;

/**
 * Item Location
 * @author Brian Parra
 */
class Iloc extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::ILOC;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}