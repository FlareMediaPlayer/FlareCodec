<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Codecs\H264\Core;

/**
 * Description of NalUnitType
 *
 * @author Brian Parra
 */
class NalUnitType {
    
    private $code;
    private $description;

    //put your code here
    private static $unitTable = [
        0 => ["Description" => "Unspecified"],
        1 => ["Description" => "Coded slice of a non-IDR picture"],
        2 => ["Description" => "coded slice data partition A"],
        3 => ["Description" => "Coded slice data partition B"],
        4 => ["Description" => "Coded slice data partition C"],
        5 => ["Description" => "Coded slice of an IDR picture"],
        6 => ["Description" => "Supplemental enhancement information"],
        7 => ["Description" => "Sequence Parameter set"],
        8 => ["Description" => "Picture Parameter Set"],
        9 => ["Description" => "Access unit Delimeter"],
        10 => ["Description" => "End of sequence"],
        11 => ["Description" => "End of strem"],
        12 => ["Description" => "Filter Data"],
    ];

    
    public function getCode(){
        return $this->code;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    private function __construct($code, $description) {
        $this->code = $code;
        $this->description = $description;
    }
    
    public static function Create($code){
        return new NalUnitType($code, self::$unitTable[$code]["Description"]);
    }

}
