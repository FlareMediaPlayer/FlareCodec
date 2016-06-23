<?php

namespace Flare\Formats\Iso\Presentation;

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

    public function addNewTrack() {
        $newTrack = new \Flare\Formats\Iso\Presentation\AudioTrack($this);
        $this->trackMap[] = $newTrack;
        //var_dump(get_class($newTrack->getTrak()));
        $this->moov->addBox($newTrack->getTrak()); //Connect the trac to the moov box
        $this->trackCount++;
    }

    public function addTrack($track) {
        $this->trackMap[] = $track;
        $this->moov->addBox($track->getTrak()); //Connect the trak to the moov box
        $this->trackCount++;
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
        $track = Track::createMappedTrack($trak);
        //$track->setMovie($this);
        //$this->trackMap[] = $track;
    }

    /**
     * Returns an array with details about the movie
     */
    public function getMovieDetails(){
        
    }
}
