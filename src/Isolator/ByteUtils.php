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

    public static function readUnsingedInteger($file) {
        $dataBuffer = fread($file, 4);
        $dataBuffer = unpack("N", $dataBuffer);
        return $dataBuffer[1];
    }

    public static function writeUnsignedInteger($file, $data) {
        $dataBuffer = pack("N", $data);
        fwrite($file, $dataBuffer);
    }

    public static function readUnsingedLong($file) {
        $dataBuffer = fread($file, 8);
        $dataBuffer = unpack("J", $dataBuffer);
        return $dataBuffer[1];
    }

    public static function writeUnsignedLong($file, $data) {
        $dataBuffer = pack("J", $data);
        fwrite($file, $dataBuffer);
    }

    public static function readBoxType($file) {
        $dataBuffer = fread($file, 4);
        $dataBuffer = unpack("C*", $dataBuffer);
        return chr($dataBuffer[1]) . chr($dataBuffer[2]) . chr($dataBuffer[3]) . chr($dataBuffer[4]);
    }

    public static function read4Char($file) {
        $dataBuffer = fread($file, 4);
        $dataBuffer = unpack("C*", $dataBuffer);
        return chr($dataBuffer[1]) . chr($dataBuffer[2]) . chr($dataBuffer[3]) . chr($dataBuffer[4]);
    }

    public static function writeChars($file, $data) {
        fwrite($file, $data);
    }

    public static function writeCString($file, $data) {
        fwrite($file, $data . "\0");
    }
    
    public static function readUnsignedByte($file) {
        $dataBuffer = fread($file, 1);
        $dataBuffer = unpack("C*", $dataBuffer);
        return $dataBuffer[1];
    }

    public static function writeUnsignedByte($file, $data) {
        $dataBuffer = pack("C", $data);
        fwrite($file, $dataBuffer);
    }

    public static function readUnsignedShort($file) {
        $dataBuffer = fread($file, 2);
        $dataBuffer = unpack("n", $dataBuffer);
        return $dataBuffer[1];
    }
    
    public static function writeUnsignedShort($file, $data) {        
        $dataBuffer = pack("n", $data);
        fwrite($file, $dataBuffer);
    }

    public static function skipBytes($file, $num) {
        $currentPosition = ftell($file);
        $newPosition = $currentPosition + $num;
        fseek($file, $newPosition);
    }
    
    public static function padBytes($file, $num) {
        $dataBuffer = pack("C", 0);
        for($i = 0 ; $i< $num ; $i++){
            fwrite($file, $dataBuffer);
        }
    }

    public static function readFixedPoint16_16($file) {

        $dataBuffer = fread($file, 4);
        $dataBuffer = unpack("N", $dataBuffer);
        $x = pow(2, 16);
        return $dataBuffer[1] / $x;
    }
    
    public static function writeFixed16_16($file, $data) {
        $x = pow(2, 16);
        $dataBuffer = pack("N", $data * $x);
        fwrite($file, $dataBuffer);
    }

    public static function readFixedPoint8_8($file) {

        $dataBuffer = fread($file, 2);
        $dataBuffer = unpack("n", $dataBuffer);
        $x = pow(2, 8);
        return $dataBuffer[1] / $x;
    }
    
    public static function writeFixed8_8($file, $data) {
        $x = pow(2, 8);
        $dataBuffer = pack("n", $data * $x);
        fwrite($file, $dataBuffer);
    }

    public static function readBytesAsHex($file, $n) {
        $dataBuffer = fread($file, $n);
        $dataBuffer = unpack("H*", $dataBuffer);
        return $dataBuffer;
    }

    public static function readString($file, $chars) {
        if ($chars == 0) {
            return null;
        }
        $string = "";
        $dataBuffer = fread($file, $chars);
        $dataBuffer = unpack("C*", $dataBuffer);

        for ($i = 1; $i <= count($dataBuffer); $i++) {
            // var_dump(chr($dataBuffer[$i]));
            $string .= chr($dataBuffer[$i]);
        }
        return $string;
    }

}
