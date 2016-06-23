<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Group Id To Name
 * @author Brian Parra
 */
class Gitn extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::GITN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}