<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Independent and Disposable Samples
 * @author Brian Parra
 */
class Sdtp extends \Flare\Formats\Iso\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::SDTP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}