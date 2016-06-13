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

        $this->iso = $iso;
        $this->file = $iso->getFile();
        $this->moov = new \Isolator\Boxes\Moov($this->file); //Generate moov box
        $this->mvhd = new \Isolator\Boxes\Mvhd($this->file); //Generate header
        $this->moov->addBox($this->mvhd);
        $this->trackMap = [];
        
    }

    public function addTrack($track = null) {
        //We have to build an entire trak, then copy details over if available
        //For now this one is an audio track
        
        $trak = new \Isolator\Boxes\Trak($this->file);
        $this->moov->addBox($trak);
        
        $tkhd = new \Isolator\Boxes\Tkhd($this->file);
        $trak->addBox($tkhd);
        
        $mdia = new \Isolator\Boxes\Mdia($this->file);
        $trak->addBox($mdia);
        
        $mdhd = new \Isolator\Boxes\Mdhd($this->file);
        $mdia->addBox($mdhd);
        
        $hdlr = new \Isolator\Boxes\Hdlr($this->file);
        $mdia->addBox($hdlr);
        
        $minf = new \Isolator\Boxes\Minf($this->file);
        $mdia->addBox($minf);
        
        $smhd = new \Isolator\Boxes\Smhd($this->file);
        $minf->addBox($smhd);
        
        $dinf = new \Isolator\Boxes\Dinf($this->file);
        $minf->addBox($dinf);
        
        $dref = new \Isolator\Boxes\Dref($this->file);
        $dinf->addBox($dref);
        
        $url = new \Isolator\Boxes\Url($this->file);
        $dref->addBox($url);
        
        $stbl = new \Isolator\Boxes\Stbl($this->file);
        $minf->addBox($stbl);
        
        $stsd = new \Isolator\Boxes\Stsd($this->file);
        $stbl->addBox($stsd);
        
        $stts= new \Isolator\Boxes\Stts($this->file);
        $stbl->addBox($stts);
        
        $stsc = new \Isolator\Boxes\Stsc($this->file);
        $stbl->addBox($stsc);
        
        $stsz = new \Isolator\Boxes\Stsz($this->file);
        $stbl->addBox($stsz);
        
        $stco = new \Isolator\Boxes\Stco($this->file);
        $stbl->addBox($stco);
        
        $this->trackMap[] = new \Isolator\Presentation\Track($trak);
        $track->setMovie($this);
        
        
        
        $this->trackCount++;
        //var_dump($track->getTrak());
        //$this->moov->addBox($track->getTrak());
        
    }

    public function finalize() {
        
        $this->iso->addBox($this->moov);
        $this->moov->writeToFile();
        
    }

}
