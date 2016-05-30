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
    private $boxMap;

    function __construct($filename) {

        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("Unable to open file!");
        $this->fileSize = filesize($filename);
        $this->boxMap = [];
        $this->loadData();
        var_dump($this->boxMap);

        
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
            

            if (array_key_exists($boxType, Box::$boxTable)) {
                $this->boxMap[] = Box::$boxTable[$boxType]->newInstance();
            }

            

            $offset += $boxSize;
            
        } while ($offset < $this->fileSize);
    }

}
