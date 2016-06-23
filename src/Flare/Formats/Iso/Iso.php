<?php

namespace Flare\Formats\Iso;

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
        $this->movie = new Presentation\Movie($this); //Initialize the presentation holder
    }
    

    public function getFileName(){
        return $this->filename;
    }

    public function getBoxMap(){
        return $this->boxMap;
    }
    

    public function loadData() {

        $offset = 0;
        $boxSize;
        $boxType;
        $dataBuffer;
        $newBox;
        
        do {
                
            $newBox = Box::parseTopLevelBox($this->file, $offset, $this);
            
            if($newBox instanceof \Flare\Formats\Iso\Boxes\Moov){
                $this->moov = $newBox;
            }
                
            $offset += $newBox->getSize();
        } while ($offset < $this->fileSize);
        
        $this->loadMovieDataFromFile(); // Now we can fill in the generated information into the movie data
        
    }
    
    /**
     * Use this function to fill in the Movie information after mapping the file
     */
    public function loadMovieDataFromFile(){
        
        $moovTracks = $this->moov->getBoxMap();
        foreach($moovTracks as $box){
            $boxType = get_class($box);
            
            switch (true){
               
                case $box instanceof Box::$boxTable[Box::MVHD] :
                    //If we encounter a movie header, import the data to the movie
                    $this->movie->setMvhdData($box);
                    break;
                
                case $box instanceof Box::$boxTable[Box::TRAK] :
                    //Load each mapped track
                    $this->movie->addMappedTrack($box);
                    break;
                 
                default :

                    //For now don't add other boxes to the movie
            }
            
        }
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

    
    public function getMoov(){
        foreach($this->boxMap as $box){
            if( $box instanceof \Flare\Formats\Iso\Boxes\Moov)
                return $box;
        }
    }
    
    public function getMvhd(){
        foreach($this->getMoov()->getBoxMap() as $box){
            if( $box instanceof \Flare\Formats\Iso\Boxes\Mvhd)
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
        $ftyp = new \Flare\Formats\Iso\Boxes\Ftyp($iso->getFile());
        //$ftyp->loadDataFromBox($inputIso->getFtyp());
        $ftyp->setMajorBrand("isom");
        $ftyp->setMinorVersion(512);
        $ftyp->setCompatibleBrands(["isom","iso2"]);
        
        $iso->addBox($ftyp);
        
        $free = new \Flare\Formats\Iso\Boxes\Free($iso->getFile());
        $iso->addBox($free);
        $free->setFreeBytes(0); //Add some extra padding to extend header size if necessary
        $ftyp->writeToFile();
        $free->writeToFile();
        
        
        $mdat = new \Flare\Formats\Iso\Boxes\Mdat($iso->getFile()); //This is what will be used to control movie recording/reading
        
        
        $iso->addBox($mdat);
        
        $mdat->prepareForWriting();
        
        $audioTracks = $inputIso->getAudioTracks();
        $dataBuffer = new DataBuffer();
        
        

        foreach ($audioTracks as $track){
            

            $audioTrack = $inputIso->addMappedAudioTrack($track);
            

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
    
    public function addMappedTrack($trak){
        
        $this->movie->addMappedTrack($trak);
        
    }


    public function addMappedAudioTrack($trak){
        
        return Presentation\Movie::createMappedAudioTrack($this->movie, $trak);
    
    }
    
    public function addNewAudioTrack(){

        return Presentation\Movie::createNewAudioTrack($this->movie);
        
    }
    
}
