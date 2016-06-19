<?php

namespace Flare\Boxes;

/**
 * Independent and Disposable Samples
 * @author Brian Parra
 */
class Sdtp extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::SDTP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}