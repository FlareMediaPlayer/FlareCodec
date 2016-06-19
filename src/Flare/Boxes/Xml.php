<?php

namespace Flare\Boxes;

/**
 * XML Container
 * @author Brian Parra
 */
class Xml extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::XML;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}