<?php


namespace Flare\Formats\Iso\Boxes;

/**
 * Description of Unknown
 *
 * @author Brian Parra
 */
class Unknown extends \Flare\Formats\Iso\Box{
    //put your code here
    function __construct($file) {

        $this->boxType = "Unknown";
        parent::__construct($file);
    }
    
    public function loadData() {
        
    }
}
