<?php

namespace Isolator\Presentation;

/**
 * Description of Movie
 *
 * @author Brian Parra
 */
class Movie {

    //put your code here
    private $moov; //Container for moov
    private $mvhd; //The movie header
    private $trackCount = 0; //
    private $trackMap;
    private $file;
    private $iso;

    public function __construct($iso) {
        //This part needs to be redone, need to have way to load a blank one vs one from file;
        $this->iso = $iso;
        $this->file = $iso->getFile();
        $this->moov = new \Isolator\Boxes\Moov($this->file); //Generate moov box
        $this->mvhd = new \Isolator\Boxes\Mvhd($this->file); //Generate header
        $this->moov->addBox($this->mvhd);
        $this->trackMap = [];
        
    }

    public function addNewTrack(){
        $newTrack = new \Isolator\Presentation\AudioTrack($this);
        $this->trackMap[] = $newTrack;
        //var_dump(get_class($newTrack->getTrak()));
        $this->moov->addBox($newTrack->getTrak()); //Connect the trac to the moov box
        $this->trackCount++;
    }
    
    public function addTrack($track){
        $this->trackMap[] = $track;
        $this->moov->addBox($track->getTrak()); //Connect the trak to the moov box
        $this->trackCount++;
    }

    public function finalize() {
        
        $this->iso->addBox($this->moov);
        $this->moov->writeToFile();
        
    }
    
    public static function createNewAudioTrack($movie){
        $newTrack = new \Isolator\Presentation\AudioTrack($movie);
        $movie->addTrack($newTrack); // Connect the newly added track to the movie
        return $newTrack;
    }
    
    public static function createMappedAudioTrack($movie, $trak){
        $newTrack = new \Isolator\Presentation\AudioTrack($movie);
        $newTrack->mapFromTrak($trak); //Copy the stats over from the boxes
        $movie->addTrack($newTrack); // Connect the newly added track to the movie
        return $newTrack;
    }
    
    public function getFile(){
        return $this->file;
    }

}
