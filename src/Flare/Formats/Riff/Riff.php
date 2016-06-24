<?php

namespace Flare\Formats\Riff;

/**
 * Riff File container
 *
 * @author Brian Parra
 */
class Riff {
    
    protected $filename;
    protected $file;
    protected $fileSize;
    protected $chunkMap;
    protected $header;
    
    public function __construct($filename) {
        echo "loading riff file";
        $this->filename = $filename;
        $this->file = fopen($this->filename, "rb+") or die("cant find file!");
        $this->fileSize = filesize($filename);
    }
    
    public function loadData(){
        
    }

}
