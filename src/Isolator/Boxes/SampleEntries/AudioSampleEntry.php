<?php

namespace Isolator\Boxes\SampleEntries;

/**
 * Description of AudioSampleEntry
 *
 * @author Brian Parra
 */
abstract class AudioSampleEntry extends \Isolator\Boxes\SampleEntries\SampleEntry {

    protected $channelCount = 2;
    protected $sampleSize = 16;
    protected $sampleRate;
    //put your code here
    function __construct($file) {

        parent::__construct($file);
    }
    
    public function loadData(){
        parent::loadData();
        
        \Isolator\ByteUtils::skipBytes($this->file, 8);//Reserved bytes
        $this->channelCount = \Isolator\ByteUtils::readUnsignedShort($this->file);
        $this->sampleSize = \Isolator\ByteUtils::readUnsignedShort($this->file);
        \Isolator\ByteUtils::skipBytes($this->file, 2);//Reserved bytes
        \Isolator\ByteUtils::skipBytes($this->file, 2);//Reserved bytes
        $this->sampleRate = \Isolator\ByteUtils::readUnsignedShort($this->file);
        \Isolator\ByteUtils::skipBytes($this->file, 2);//Reserved bytes
                
        //var_dump(ftell($this->file));

        $this->loadChildBoxes();

         
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
