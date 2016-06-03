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

    public function getFileName(){
        return $this->filename;
    }

    public function getBoxMap(){
        return $this->boxMap;
    }
    
    
    public function displayBoxMap() {
        
        echo "<div>";
        echo "<h1>>" . basename($this->filename) . "</h1>";
        foreach ($this->boxMap as $box) {
            echo "<div>";
            $box->displayBoxMap();
            echo "box";
            echo "</div>";
        }
        echo "</div>";
        
    }

    public function displayDetailedBoxMap() {
      
        echo "<div>";
        echo "<h1>>" . basename($this->filename) . "</h1>";
        foreach ($this->boxMap as $box) {
            echo "<div>";
            $box->displayDetailedBoxMap();
            echo "</div>";
        }
        echo "</div>";
        
    }

    public function loadData() {

        $offset = 0;
        $boxSize;
        $boxType;
        $dataBuffer;
        $newBox;

        do {
            //Set the offset 
            //fseek($this->file, $offset);

            //$boxSize = ByteUtils::readUnsingedInteger($this->file);
            //$boxType = ByteUtils::readBoxType($this->file);
            

                
            $newBox = \Isolator\Box::parseTopLevelBox($this->file, $offset, $this);
                
   

            $offset += $newBox->getSize();
        } while ($offset < $this->fileSize);
    }

    public function addBox($box){
        $this->boxMap[] = $box;
    }
    


}
