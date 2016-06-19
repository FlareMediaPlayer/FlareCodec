<?php

namespace Flare\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Moov extends \Flare\Box {

    function __construct($file) {

        $this->boxType = \Flare\Box::MOOV;
        parent::__construct($file);
    }
    

    public function getBoxDetails() {
        
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;

        return $details;
    }

    public function loadData() {
        
        $this->readHeader();

        $this->loadChildBoxes();
        

    }
    
    public function getAudioTracks(){
        
        $tracks = array();
    
        foreach($this->boxMap as $box){
            if($box instanceof \Flare\Boxes\Trak){
                
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
            if($box instanceof \Flare\Boxes\Trak){
                $tracks[] = $box;
            }
        }
  
        return $tracks;
    }


    public function getMvhd(){
        foreach($this->boxMap as $box){
            if( $box instanceof \Flare\Boxes\Mvhd)
                return $box;
        }
    }
    
    public function writeToFile() {
        $this->prepareForWriting();
        foreach($this->boxMap as $box){
            $box->writeToFile();
        }
        $this->finalizeWriting();
    }
    
    public function prepareForWriting(){
        
        $this->offset = ftell($this->file); //Save the file pointer
        $this->headerSize = 8;
        \Flare\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
    }
    
    public function finalizeWriting(){
        
        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file

    }
    
}
