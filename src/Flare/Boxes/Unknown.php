<?php


namespace Flare\Boxes;

/**
 * Description of Unknown
 *
 * @author Brian Parra
 */
class Unknown extends \Flare\Box{
    //put your code here
    function __construct($file) {

        $this->boxType = "Unknown";
        parent::__construct($file);
    }
    
    public function loadData() {
        
    }
}
