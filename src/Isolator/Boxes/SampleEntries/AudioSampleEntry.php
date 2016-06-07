<?php

namespace Isolator\Boxes\SampleEntries;

/**
 * Description of AudioSampleEntry
 *
 * @author Brian Parra
 */
abstract class AudioSampleEntry extends \Isolator\Boxes\SampleEntries\SampleEntry {

    protected $channelCount;
    protected $sampleSize;
    protected $sampleRate;
    //put your code here
    function __construct($file) {

        parent::__construct($file);
    }
    
    public function getChannelCount(){
        return $this->channelCount;
    }
    
    public function getSampleRate(){
        return $this->sampleRate;
    }
    
    public function getSampleSize(){
        return $this->sampleSize;
    }

}
