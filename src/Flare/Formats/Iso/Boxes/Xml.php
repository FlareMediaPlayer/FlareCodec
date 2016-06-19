<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * XML Container
 * @author Brian Parra
 */
class Xml extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::XML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}