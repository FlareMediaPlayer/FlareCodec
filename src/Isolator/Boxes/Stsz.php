<?php

namespace Isolator\Boxes;

/**
 * Description of Stsz
 *
 * @author Brian Parra
 */
class Stsz extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STSZ;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}