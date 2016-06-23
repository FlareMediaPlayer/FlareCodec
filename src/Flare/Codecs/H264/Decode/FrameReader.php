<?php

namespace Flare\Codecs\H264\Decode;
/**
 * Description of FrameReader
 *
 * @author Brian Parra
 */
class FrameReader {
    private $SeqParameterSetMap;
    private $PictureParameterSetMap;
    
    public function __construct(){
        $this->SeqParameterSetMap = [];
        $this->PictureParameterSetMap = [];
    }
    
    public function readFrame($nalUnits){
        
    }
}
