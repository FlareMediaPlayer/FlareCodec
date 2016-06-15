<?php

namespace Isolator\Boxes;

/**
 * Description of Edts
 *
 * @author Brian Parra
 */
class Edts extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::EDTS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        $this->loadChildBoxes();
/*
        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;


        do {
            //Set the offset 

            fseek($this->file, $internalOffset);

            $boxSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Isolator\ByteUtils::readBoxType($this->file);
            


            //if (array_key_exists($boxType, \Isolator\Box::$boxTable)) {


                $newBox = //\Isolator\Box::$boxTable[$boxType]->newInstance($this->file);
                $newBox->container = $this;
                $newBox->setSize($boxSize);
                $newBox->setOffset($internalOffset);
                $newBox->loadData();
                $this->boxMap[] = $newBox;
                
            //}



            $internalOffset += $boxSize;
        } while (($internalOffset - $this->offset ) < $this->size);
 * */
 
    }

}