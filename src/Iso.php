<?php

namespace Isolator;

/**
 * Container for an iso file
 *
 * @author Brian Parra
 */
class Iso {
   
    private $filename;
    private $file;
    private $fileSize;
    
    function __construct($filename) {
        
        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("Unable to open file!");
        $this->fileSize = filesize($filename);
        
        $this->loadData();
        
    }
    
    public function loadData() {
        $offset = 0;
        $boxSize;
        $boxType;
        $dataBuffer;

        do {
            //Set the offset 
            fseek($this->file, $offset);    
            
            //Read the box size
            $dataBuffer = fread ( $this->file , 4 );
            $dataBuffer = unpack("N", $dataBuffer );
            $boxSize =$dataBuffer[1];
            
        
          
            var_dump($boxSize);

            $offset += $boxSize;
            
        } while ($offset < $this->fileSize);
 
    }
    
    
    public static function readUnsingedInteger($file){
        $dataBuffer = fread ( $file , 4 );
        $dataBuffer = unpack("N", $dataBuffer );
        return $dataBuffer[1];
    }

}
