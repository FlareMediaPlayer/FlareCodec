<?php

namespace Flare\Formats\Wave;

/**
 * Description of Wave
 *
 * @author Brian Parra
 */
class Wave extends \Flare\Formats\Riff\Riff {

    public function loadData() {

        $this->chunkMap = [];

        //First load the RIFF header box
        $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
        $this->header = Chunk::CreateChunk($fourCC, $this->file);
        $this->header->loadData();
        $this->chunkMap[] = $this->header;

        //Load the format chunk this is technically a sub chunk
        $fourCC = \Flare\Common\ByteUtils::read4Char($this->file);
        $chunk = Chunk::CreateChunk('fmt', $this->file);
        $chunk->loadData();
        $this->chunkMap[] = $chunk;
        var_dump($chunk->getDetails());

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
