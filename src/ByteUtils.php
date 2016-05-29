<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Isolator;

/**
 * Description of ByteUtils
 *
 * @author Brian Parra
 */
class ByteUtils {
    
    public static function readUnsingedInteger($file){
        $dataBuffer = fread ( $file , 4 );
        $dataBuffer = unpack("N", $binarydata );
        return $dataBuffer[1];
    }
    
}
