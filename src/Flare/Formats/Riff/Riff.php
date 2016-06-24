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
        
        $this->chunkMap = [];
        
        do {
            $fourCC = \Flare\Common\ByteUtils::read4Char($this->file); 
            switch ($fourCC){
                
                case "RIFF":
                    $this->header = Chunk::CreateChunk($fourCC , $this->file);
                    $this->header->loadData();
                    $this->chunkMap[] = $this->header;
                    var_dump($this->header);
                    break;
                
                default :
            }
            
                
          
        } while (ftell($this->file) < $this->fileSize);
        
    }
}
