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
        //var_dump($this->boxMap);
    }

    public function displayBoxMap() {
        
        echo "<pre>" . PHP_EOL;
        echo ">";
        echo basename($this->filename) . PHP_EOL;
        foreach ($this->boxMap as $box) {
          
            $box->displayBoxMap();
            
        }
        echo "</pre>";
        
    }

    public function displayDetailedBoxMap() {
        
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

                $this->boxMap[] = Box::$boxTable[$boxType]->newInstance($this->file);
            }



            $offset += $boxSize;
        } while ($offset < $this->fileSize);
    }

}
