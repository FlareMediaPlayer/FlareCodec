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

            $boxSize = ByteUtils::readUnsingedInteger($this->file);
            $boxType = ByteUtils::readBoxType($this->file);
            



            var_dump($boxSize);
            var_dump($boxType);

            $offset += $boxSize;
            
        } while ($offset < $this->fileSize);
    }

}
