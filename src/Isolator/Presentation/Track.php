<?php

/**
 * Description of Track
 *
 * @author Brian Parra
 */

namespace Isolator\Presentation;



class Track {

    private $trak;
    protected $file;
    protected $movie; // Reference to the movie container;
    
    public function setMovie($movie) {
        
        $this->movie = $movie;
         
    }
    
    public function getTrak(){
        //
        return $this->trak;
    }
    
}
