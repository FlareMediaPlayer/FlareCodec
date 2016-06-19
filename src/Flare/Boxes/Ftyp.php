<?php

namespace Flare\Boxes;

/**
 * File Type box
 * Mandatory, and can only have 1.
 * @author mac
 */
class Ftyp extends \Flare\Box {

    const ISO_BASE_MEDIA = "isom";
    const ISO_BASE_MEDIA_2 = "iso2";
    const ISO_BASE_MEDIA_3 = "iso3";
    const ISO_BASE_MEDIA_4 = "iso4";
    const ISO_BASE_MEDIA_5 = "iso5";
    const ISO_BASE_MEDIA_6 = "iso6";
    const ISO_BASE_MEDIA_7 = "iso7";
    const ISO_BASE_MEDIA_8 = "iso8";
    const ISO_BASE_MEDIA_9 = "iso9";
    const BRAND_MP4_1 = "mp41";
    const MP4_2 = "mp42";
    const MOBILE_MP4 = "mmp4";
    const QUICKTIME = "qm  ";
    const AVC = "avc1";
    const AUDIO = "M4A ";
    const AUDIO_2 = "M4B ";
    const AUDIO_ENCRYPTED = "M4P ";
    const MP7 = "mp71";

    private $majorBrand;
    private $minorVersion;
    private $compatibleBrands = [];

    function __construct($file) {

        $this->boxType = \Flare\Box::FTYP;
        parent::__construct($file);
    }

    public function loadData() {



        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }

        //Make sure file pointer is at correct position
        fseek($this->file, $this->offset + $this->headerSize);
        $this->majorBrand = \Flare\ByteUtils::read4Char($this->file);
        $this->minorVersion = \Flare\ByteUtils::readUnsingedInteger($this->file);


        while (ftell($this->file) < ($this->size + $this->offset)) {
            $this->compatibleBrands[] = \Flare\ByteUtils::read4Char($this->file);
        }
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Major Brand"] = $this->majorBrand;
        $details["Minor Version"] = $this->minorVersion;

        if (!empty($this->compatibleBrands)) {
            $details["Compatible Brands"] = [];
            foreach ($this->compatibleBrands as $brand) {
                $details["Compatible Brands"][] = $brand;
            }
        }


        return $details;
    }

    public function getMajorBrand() {

        return $this->majorBrand;
    }

    public function getMinorVersion() {

        return $this->minorVersion;
    }
    
    public function setMajorBrand($majorBrand){
        $this->majorBrand = $majorBrand;
    }
    
    public function setMinorVersion($minorVersion){
        $this->minorVersion = $minorVersion;
    }
    
    public function setCompatibleBrands($compatibleBrands){
        $this->compatibleBrands = $compatibleBrands;
    }

    public function getCompatibleBrands() {


        return $this->compatibleBrands;
    }

    public function loadDataFromBox($box) {



        $this->majorBrand = $box->getMajorBrand();
        $this->minorVersion = $box->getMinorVersion();
        $this->compatibleBrands = $box->getCompatibleBrands();
    }

    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        //This box will probably never be 64 bit
        $compatibleBrandCount = count($this->compatibleBrands);
        //size + type + major brand + minor version = 4 * 4 = 16 bytes
        $this->size = 16 + ($compatibleBrandCount * 4);


        \Flare\ByteUtils::writeUnsignedInteger($this->file,$this->size); //Write the box size
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        \Flare\ByteUtils::writeChars($this->file, $this->majorBrand); //Write the brand
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->minorVersion); //Write version
        for ($i = 0; $i < $compatibleBrandCount; $i++) {
            \Flare\ByteUtils::writeChars($this->file, $this->compatibleBrands[$i]);
        }
        
        
    }

}
