<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Isolator\Boxes;

/**
 * Description of Ftyp
 *
 * @author mac
 */
class Ftyp extends \Isolator\Box {
    
    private $majorBrand;
    
    private $minorVersion;
    
    private $compatibleBrands;

    function __construct($file) {
        $this->boxType = \Isolator\Box::FTYP;
        $this->compatibleBrands = [];
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    
    public function getMajorBrand(){
        
        $this->majorBrand;
        
    }
    
    public function getMinorVersion(){
     
        $this->minorVersion;
        
    }

    public function getCompatibleBrands(){
        
        
        return $this->compatibleBrands;
        
    }


    public function displayDetailedBoxMap(){
        
    }
}
