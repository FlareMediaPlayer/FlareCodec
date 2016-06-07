<?php

namespace Isolator\Boxes\SampleEntries;

/**
 * Description of SampleEntry
 *
 * @author Brian Parra
 */
abstract class SampleEntry extends \Isolator\Box{

    protected $dataReferenceIndex;
    
    function __construct($file) {
        parent::__construct($file);
    }
    
}
