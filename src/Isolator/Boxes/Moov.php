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
        
        $this->readHeader();

        $this->loadChildBoxes();
        

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
