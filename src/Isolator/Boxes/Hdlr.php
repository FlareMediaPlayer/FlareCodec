<?php

namespace Isolator\Boxes;

/**
 * Description of Hdlr
 *
 * @author Brian Parra
 */
class Hdlr extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::HDLR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}