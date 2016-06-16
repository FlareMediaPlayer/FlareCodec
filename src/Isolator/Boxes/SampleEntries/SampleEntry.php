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
    
    public function loadData() {
        $this->readHeader();
        \Isolator\ByteUtils::skipBytes($this->file, 6);//Reserved bytes
        $this->dataReferenceIndex = \Isolator\ByteUtils::readUnsignedShort($this->file);
    }
    
    public function setDataReferenceIndex($index){
        $this->dataReferenceIndex = $index;
    }
    
}
