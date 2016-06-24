<?php

namespace Flare\Formats\Riff;

/**
 * Riff File container
 *
 * @author Brian Parra
 */
class Riff {
    
    private $filename;
    private $file;
    private $fileSize;
    private $chunkMap;
    private $header;
    
    public function __construct($filename) {
        echo "loading riff file";
        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("Unable to open file!");
        $this->fileSize = filesize($filename);
    }
    
    public function loadData(){
        
    }

}
