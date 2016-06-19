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

require_once '../src/Flare/AutoLoader.php';


$iso = new Flare\Formats\Iso\Iso("sample.mp4");
$iso->loadData();

$rippedTrack = Flare\Formats\Iso\Iso::RipAudio($iso, "output.m4a");
Flare\IsoVisualizer::visualize($iso);

Flare\IsoVisualizer::visualize($rippedTrack);

