<?php

namespace Isolator\Boxes;

/**
 * Description of Dref
 *
 * @author Brian Parra
 */
class Stbl extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STBL;
        parent::__construct($file);
        
    }
    
    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;


        $this->loadChildBoxes();
    }

}