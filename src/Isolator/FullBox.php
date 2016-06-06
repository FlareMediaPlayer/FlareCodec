<?php
namespace Isolator;
/**
 * Description of FullBox
 *
 * @author Brian Parra
 */
abstract class FullBox extends \Isolator\Box {
    
    protected $version; //1 byte
    protected $flags = []; // 3 bytes 
    
    function __construct($file) {

        parent::__construct($file);  
        
    }
    

    
}
