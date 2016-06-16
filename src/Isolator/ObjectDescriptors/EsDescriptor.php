<?php

namespace Isolator\ObjectDescriptors;

/**
 * Description of EsDescriptor
 *
 * @author Brian Parra
 */
class EsDescriptor {
    
    private $file;
    
    public function __construct($file) {
        $this->file = $file;
    }
    
    public function writeToFile(){
        $data = "03808080220001000480808014401500000000065BC00005D424058080800211B0068080800102";
        $binary_string = pack("H*" , $data);
        fwrite($this->file, $binary_string);
    }
}
