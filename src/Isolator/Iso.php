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


    public function displaySimpleBoxMap() {
        
        echo "<div>";
        echo "<h1>>" . basename($this->filename) . "</h1>";
        foreach ($this->boxMap as $box) {
            echo "<div>";
            $box->displaySimpleBoxMap();
            echo "</div>";
        }
        echo "</div>";
        
    }

    public function displayDetailedBoxMap() {
        
        $this->displaySimpleBoxMap();
        
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

                $newBox = Box::$boxTable[$boxType]->newInstance($this->file);
                $newBox->setSize($boxSize);
                $newBox->setOffset($offset);
                $newBox->loadData();
                $this->boxMap[] = $newBox;
            }



            $offset += $boxSize;
        } while ($offset < $this->fileSize);
    }

    public static function quickMap($filename, $detailed = false) {

        $quick = new Iso($filename);
        
        if($detailed){
            
            $quick->displayDetailedBoxMap();
            
        }else{
            
            $quick->displaySimpleBoxMap();
            
        }
  
    }

}
