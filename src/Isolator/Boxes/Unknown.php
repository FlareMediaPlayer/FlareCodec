<?php


namespace Isolator\Boxes;

/**
 * Description of Unknown
 *
 * @author Brian Parra
 */
class Unknown extends \Isolator\Box{
    //put your code here
    function __construct($file) {

        $this->boxType = "Unknown";
        parent::__construct($file);
    }
    
    public function loadData() {
        
    }
}
