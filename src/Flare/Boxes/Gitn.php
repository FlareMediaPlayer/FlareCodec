<?php

namespace Flare\Boxes;

/**
 * Group Id To Name
 * @author Brian Parra
 */
class Gitn extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::GITN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}