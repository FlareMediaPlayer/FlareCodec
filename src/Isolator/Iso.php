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
    private $moov; //Keep direct reference to movie box to not waste time iterating every time

    function __construct($filename) {

        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("Unable to open file!");
        $this->fileSize = filesize($filename);
        $this->boxMap = [];
        //$this->loadData();
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
            
            if($newBox instanceof \Isolator\Boxes\Moov){
                $this->moov = $newBox;
           
                
            }
                
   

            $offset += $newBox->getSize();
        } while ($offset < $this->fileSize);
    }

    public function addBox($box){
        
        $this->boxMap[] = $box;
        
    }
    

    public function getAudioTracks(){
        return $this->moov->getAudioTracks();
    }
    
    
    public function getTrackByID($trackID){
        
        $moovTracks = $this->moov->getTracks();
        foreach($moovTracks as $box){
            if( $box->getTrackID() == $trackID)
                return $box;
        }
        
        return null;
    }
    
    public static function IsoFileFrom(){
        
    }
    
    function createEmptyIso(){
        
    }
    
    function getFtyp(){
        foreach($this->boxMap as $box){
            if( $box instanceof \Isolator\Boxes\Ftyp)
                return $box;
        }
    }
    
    public function getMoov(){
        foreach($this->boxMap as $box){
            if( $box instanceof \Isolator\Boxes\Moov)
                return $box;
        }
    }
    
    public function getMvhd(){
        foreach($this->getMoov()->getBoxMap() as $box){
            if( $box instanceof \Isolator\Boxes\Mvhd)
                return $box;
        }
    }

/*
    public static function RipAudio($inputIso, $outputFile){
        
        if(file_exists ( $outputFile)){
            unlink ($outputFile);
        }
        
        //Fix this later
        $file = fopen($outputFile,"w");
        fclose($file);
        
        $iso = new Iso($outputFile);
        
        //Need to rethink the constructors
        $ftyp = new \Isolator\Boxes\Ftyp($outputFile);
        $ftyp->loadDataFromBox($inputIso->getFtyp());
        
        
        
        $moov = new \Isolator\Boxes\Moov($outputFile);
        $mvhd = new \Isolator\Boxes\Mvhd($outputFile);
        $mvhd->loadDataFromBox($inputIso->getMvhd());
        
        $iso->addBox($ftyp);
        $moov->addBox($mvhd);
        $mvhd->setContainer($moov);
        $iso->addBox($moov);
        
        $audioTracks = $inputIso->getAudioTracks();
        
        foreach ($audioTracks as $track){
            $audioTrack = new \Isolator\Presentation\AudioTrack($track);
            //$audioTrack->setOutputFile($outputFile);
        }
        
        return $iso;
        
    }
    */
    
    
    
}
