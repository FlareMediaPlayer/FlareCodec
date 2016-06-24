<?php

namespace Flare\Formats\Riff\Chunks;

/**
 * Description of RIFF
 *
 * @author Brian Parra
 */
class RIFF extends \Flare\Formats\Riff\Chunk{
    
    private $format;
    
    public function __construct($dwFourCC, $file) {
        parent::__construct($dwFourCC, $file);
        
    }
    
    public function loadData(){
        $this->format = \Flare\Common\ByteUtils::read4Char($this->file);
    }
    
    public function getDetails(){
        $details = [];
        $details["code"] = $this->dwFourCC;
        $details["offset"] = $this->offset;
        $details["chunkSize"] = $this->dwChunkSize;
        $details["format"] = $this->format;
        return $details;
    }
}
