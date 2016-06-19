<?php

namespace Flare\Boxes\SampleEntries;

/**
 * Description of SampleEntry
 *
 * @author Brian Parra
 */
abstract class SampleEntry extends \Flare\Box{

    protected $dataReferenceIndex;
    
    function __construct($file) {
        parent::__construct($file);
    }
    
    public function loadData() {
        $this->readHeader();
        \Flare\ByteUtils::skipBytes($this->file, 6);//Reserved bytes
        $this->dataReferenceIndex = \Flare\ByteUtils::readUnsignedShort($this->file);
    }
    
    public function setDataReferenceIndex($index){
        $this->dataReferenceIndex = $index;
    }
    
}
