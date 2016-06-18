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
    private $tempTrack; // Needed for testing, later switch with some sort of abstract container
    private $movie; //Create a single movie instance.

    function __construct($filename) {

        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("Unable to open file!");
        $this->fileSize = filesize($filename);
        $this->boxMap = [];
         //$test = new \Isolator\Boxes\Mdat($this->file);
        //$this->movie = new \Isolator\Presentation\Movie($this);
        //$this->movie = new Presentation\nob();
        //$this->loadData();
        //var_dump($this->boxMap);
        //$this->initMovie();
        $this->movie = new \Isolator\Presentation\Movie($this); //Initialize the presentation holder
    }
    
    function initMovie(){
        $this->movie = new \Isolator\Presentation\Movie($this);
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
    
    public function getFile(){
        return $this->file;
    }

    public function addNewTrack(){
        $this->movie->addNewTrack();
    }

    public static function RipAudio($inputIso, $outputFile){
        
       //var_dump(get_class($inputIsovar));
        if(file_exists ( $outputFile)){
            unlink ($outputFile);
        }
        
        //Fix this later
        $out = fopen($outputFile,"w");
        
        
        $iso = new Iso($outputFile);
        //$iso->initMovie();
        
        //Need to rethink the constructors
        $ftyp = new \Isolator\Boxes\Ftyp($iso->getFile());
        //$ftyp->loadDataFromBox($inputIso->getFtyp());
        $ftyp->setMajorBrand("isom");
        $ftyp->setMinorVersion(512);
        $ftyp->setCompatibleBrands(["isom","iso2"]);
        
        $iso->addBox($ftyp);
        
        $free = new \Isolator\Boxes\Free($iso->getFile());
        $iso->addBox($free);
        $free->setFreeBytes(0); //Add some extra padding to extend header size if necessary
        $ftyp->writeToFile();
        $free->writeToFile();
        
        
        $mdat = new \Isolator\Boxes\Mdat($iso->getFile()); //This is what will be used to control movie recording/reading
        
        
        $iso->addBox($mdat);
        
        $mdat->prepareForWriting();
        
        $audioTracks = $inputIso->getAudioTracks();
        $dataBuffer = new \Isolator\DataBuffer();

        foreach ($audioTracks as $track){
            
            //$audioTrack = new \Isolator\Presentation\AudioTrack($track);
            $audioTrack = $inputIso->addMappedAudioTrack($track);
            
            $audioTrack->setOutputFile($outputFile);
            //$audioTrack->dumpBinary($iso->getFile()); // Testing for now
            $newAudioTrack = $iso->addNewAudioTrack();
            
            
            //now we connect the input iso to the newly made iso
            $dataBuffer->setInputTrack($audioTrack);
            $dataBuffer->setOutputTrack($newAudioTrack); // We would like to write to the new audio track;
            //var_dump(get_class($newAudioTrack));
      
            for($i = 0; $i < $audioTrack->getSampleCount(); $i++ ){
                $dataBuffer->readSample();
                $dataBuffer->writeSample();
            }
        }
        
        $mdat->finalizeWriting();
        $iso->finalize();
        
        
        return $iso;
        
    }
    
    public function setTempTrack($track){
        $this->tempTrack = $track;
    }
    
    
    public function finalize(){

        $this->movie->finalize();
        
    }
    
    public function addMappedAudioTrack($trak){
        
        return \Isolator\Presentation\Movie::createMappedAudioTrack($this->movie, $trak);
    }
    
    public function addNewAudioTrack(){

        return \Isolator\Presentation\Movie::createNewAudioTrack($this->movie);
    }
    
}
