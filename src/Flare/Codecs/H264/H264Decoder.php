<?php

namespace Flare\Codecs\H264;

/**
 * Description of H264Decoder
 *
 * @author Brian Parra
 */
class H264Decoder extends \Flare\Core\VideoDecoder {
    private $frameReader;


    public function __construct() {
        $this->frameReader = new Decode\FrameReader(); 
        echo "H264 Decoder test";
    }


    public function decodeFrame() {
        
    }

}
