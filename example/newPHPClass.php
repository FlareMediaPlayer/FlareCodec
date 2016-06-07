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
error_reporting(-1);

require_once '../src/Isolator/AutoLoader.php';


$iso = new  Isolator\Iso("sample.mp4");
$audioTracks = $iso->getAudioTracks();
foreach($audioTracks as $audioTrack){
    echo "Track ID : " . $audioTrack->getTrackID();
}
Isolator\IsoVisualizer::visualize($iso);

