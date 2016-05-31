<?php

/**
 * Description of newPHPClass
 *
 * @author Brian Parra
 */
require_once '../src/Isolator/AutoLoader.php';


$iso = new  Isolator\Iso("sample.mp4");
$iso->displayBoxMap();

