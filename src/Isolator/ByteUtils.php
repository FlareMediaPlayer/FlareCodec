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
        $dataBuffer = unpack("N", $dataBuffer );
        return $dataBuffer[1];
    }
    
    public static function readBoxType($file){
        $dataBuffer = fread ( $file , 4 );
        $dataBuffer = unpack("C*", $dataBuffer );
        return chr($dataBuffer[1]) . chr($dataBuffer[2]) . chr($dataBuffer[3]) . chr($dataBuffer[4]);
    }
    
    
}
