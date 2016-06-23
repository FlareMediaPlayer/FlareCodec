<?php

namespace Flare\Core;
/**
 * Description of VideoDecoder
 *
 * @author Brian Parra
 */
abstract class VideoDecoder {
    
    public function __construct() {
        echo "H264 decoder test";
    }
    
    public abstract function decodeFrame();
    
    
    
}
