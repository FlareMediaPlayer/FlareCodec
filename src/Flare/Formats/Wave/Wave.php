<?php

namespace Flare\Formats\Wave;

/**
 * Wave is a subclass of the RIFF file structure
 *
 * @author Brian Parra
 */
class Wave extends \Flare\Formats\Riff\Riff {

    public function __construct($filename) {
        parent::__construct($filename);
    }
    
    public function loadData() {

        $this->chunkMap = [];

        //First load the RIFF header box
        $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
        $this->header = new \Flare\Formats\Riff\Chunks\RIFF($this->file);
        $this->header->loadData();
        $this->chunkMap[] = $this->header;

        //Load the format chunk this is technically a sub chunk
        
        $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
        $chunk = new Chunks\Fmt( $this->file);
        $chunk->loadData();
        $this->chunkMap[] = $chunk;
        
        $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
        $chunk = new Chunks\Data( $this->file);
        $chunk->loadData();
        $this->chunkMap[] = $chunk;
         
         

        /*
          do {
          $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
          switch ($fourCC){



          default :
          }



          } while (ftell($this->file) < $this->fileSize);
         */
    }

}
