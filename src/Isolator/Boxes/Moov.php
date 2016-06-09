<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Moov extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::MOOV;
        parent::__construct($file);
    }
    

    public function getBoxDetails() {
        
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;

        return $details;
    }

    public function loadData() {
        
        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }
        
        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;


        do {
            //Set the offset 
            
            fseek($this->file, $internalOffset);

            $boxSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Isolator\ByteUtils::readBoxType($this->file);
            


            if (array_key_exists($boxType, \Isolator\Box::$boxTable)) {


                $newBox = \Isolator\Box::$boxTable[$boxType]->newInstance($this->file);
                $newBox->container = $this;
                $newBox->setSize($boxSize);
                $newBox->setOffset($internalOffset);
                $newBox->loadData();
                $this->boxMap[] = $newBox;
                
            }



            $internalOffset += $boxSize;
        } while (($internalOffset - $this->offset ) < $this->size);
        

    }
    
    public function getAudioTracks(){
        
        $tracks = array();
    
        foreach($this->boxMap as $box){
            if($box instanceof \Isolator\Boxes\Trak){
                
                //Check if audio track
                if($box->isAudioTrack()){
                    $tracks[] = $box;
                }
                
            }
        }
  
        return $tracks;

    }
    
    public function getTracks(){
      
        $tracks;
    
        foreach($this->boxMap as $box){
            if($box instanceof \Isolator\Boxes\Trak){
                $tracks[] = $box;
            }
        }
  
        return $tracks;
    }


    public function getMvhd(){
        foreach($this->boxMap as $box){
            if( $box instanceof \Isolator\Boxes\Mvhd)
                return $box;
        }
    }
    
}
