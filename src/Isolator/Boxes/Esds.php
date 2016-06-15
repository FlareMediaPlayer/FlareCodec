<?php

namespace Isolator\Boxes;

/**
 * Description of Esds
 *
 * @author Brian Parra
 */
class Esds extends \Isolator\Box{

    private $EsDescriptor;
    
    function __construct($file) {

        $this->boxType = \Isolator\Box::ESDS;
        parent::__construct($file);
        
    }

    public function loadData() {
        $this->readHeader();
    }

}
