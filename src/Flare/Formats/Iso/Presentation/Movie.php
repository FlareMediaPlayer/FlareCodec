<?php

namespace Flare\Formats\Iso\Presentation;

/**
 * This is an abstract representation of a movie built from the boxes.
 * A mapped file should automatically generate one of these that makes the demuxers on each track.
 * 
 *
 * @author Brian Parra
 */
class Movie {

    //put your code here
    private $moov; //Container for moov
    private $mvhd; //The movie header
    private $trackCount = 0; //
    private $trackMap; //Mapping of each Track complete with muxers
    private $file;
    private $iso;

    public function __construct($iso) {
        //This part needs to be redone, need to have way to load a blank one vs one from file;
        $this->iso = $iso;
        $this->file = $iso->getFile();
        $this->moov = new \Flare\Formats\Iso\Boxes\Moov($this->file); //Generate moov box
        $this->mvhd = new \Flare\Formats\Iso\Boxes\Mvhd($this->file); //Generate header
        $this->moov->addBox($this->mvhd);
        $this->trackMap = [];
    }



    public function addTrack($track) {
        $this->trackMap[] = $track;
        $this->moov->addBox($track->getTrak()); //Connect the trak to the moov box
        $this->trackCount++;
    }
    
    public function getTracks(){
        return $this->trackMap;
    }
    
    public function getAudioTracks(){
        $audioTracks = [];
        foreach($this->trackMap as $track){
           if ($track->getHandlerType() == \Flare\Formats\Iso\Boxes\Hdlr::SOUN){
               $audioTracks[] = $track;
           }
        }
        return $audioTracks;
    }

    public function finalize() {
        $duration = 0;
        $trackCount = 1;
        foreach ($this->trackMap as $track) {

            $track->setTrackId($trackCount);
            $track->finalize();
            if ($track->getDurationInRealTime() > $duration) {
                $duration = $track->getDurationInRealTime();
            }

            $trackCount++;
        }
        $this->iso->addBox($this->moov);
        $this->mvhd->setDuration($duration);
        $this->mvhd->setNextTrackID($this->trackCount + 1);

        $this->moov->writeToFile();
    }

    public static function createNewAudioTrack($movie) {
        $newTrack = new \Flare\Formats\Iso\Presentation\AudioTrack($movie);
        $movie->addTrack($newTrack); // Connect the newly added track to the movie
        return $newTrack;
    }

    public static function createMappedAudioTrack($movie, $trak) {
        $newTrack = new \Flare\Formats\Iso\Presentation\AudioTrack($movie);
        $newTrack->mapFromTrak($trak); //Copy the stats over from the boxes
        $movie->addTrack($newTrack); // Connect the newly added track to the movie
        return $newTrack;
    }

    public function getFile() {
        return $this->file;
    }

    /**
     * This function imports data from a mapped mvhd box
     */
    public function setMvhdData($mvhd) {
        //For now just swap the reference
        //Perhaps copying individual fields provides better performance later
        $this->mvhd = $mvhd;
    }

    /**
     * Takes an existing mapped trak and builds an abstract track and adds to movie
     * @param Trak
     */
    public function addMappedTrack($trak) {
        $track = Track::createMappedTrack($trak , $this);
        $this->trackMap[] = $track;
        $track->mapFromTrak($trak);
        $this->trackCount++;
        return $track;
    }
    
    public function addNewTrack() {
        $newTrack = new \Flare\Formats\Iso\Presentation\AudioTrack($this);
        $this->trackMap[] = $newTrack;
        $this->moov->addBox($newTrack->getTrak()); //Connect the trac to the moov box
        $this->trackCount++;
        
    }
    
    /**
     * This function adds a new blank track using the properties from an exisitng Track
     * Right now the track properties are hard coded in AudioTrack but should import
     * @param type Track
     */
    public function addNewTrackFromProperties($track){
        
        $handlerType = $track->getHandlerType();
        
        $newTrack = Track::CreateNewTrack($this, $handlerType);
        $this->trackMap[] = $newTrack;
        $this->trackCount++;
        $this->moov->addBox($newTrack->getTrak()); //Connect the trac to the moov box
        //Now do any other necessary copying
        return $newTrack;
            
    }

    /**
     * Returns an array with details about the movie
     */
    public function getMovieDetails(){
        
    }
    
    public function getTrackCount(){
        return $this->trackCount;
    }
}
