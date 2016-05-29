<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author mac
 */
include '../src/Iso.php';
use Isolator;

$iso = new Isolator\Iso("sample.mp4");

//$binarydata = "x04x00xa0x00";
//$binarydata = "x0400a000";
//$dataBuffer = unpack("c*chars", $binarydata );
//var_dump($dataBuffer);