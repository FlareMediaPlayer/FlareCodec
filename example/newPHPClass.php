<?php

/**
 * Description of newPHPClass
 *
 * @author Brian Parra
 */

// ----------------------------------------------------------------------------------------------------
// - Display Errors
// ----------------------------------------------------------------------------------------------------
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

// ----------------------------------------------------------------------------------------------------
// - Error Reporting
// ----------------------------------------------------------------------------------------------------
error_reporting((E_ALL));

require_once '../src/Isolator/AutoLoader.php';


$iso = new  Isolator\Iso("sample.mp4");
$iso->loadData();
//$audioTracks = $iso->getAudioTracks();

$rippedTrack = Isolator\Iso::RipAudio($iso, "output.m4a");
Isolator\IsoVisualizer::visualize($iso);

Isolator\IsoVisualizer::visualize($rippedTrack);

