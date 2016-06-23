<?php

namespace Flare\Formats\Iso\Boxes\SampleEntries;

/**
 * Description of SampleEntry
 *
 * @author Brian Parra
 */
abstract class SampleEntry extends \Flare\Formats\Iso\Box{

    protected $dataReferenceIndex;
    
    function __construct($file) {
        parent::__construct($file);
    }
    
    public function loadData() {
        $this->readHeader();
        \Flare\Common\ByteUtils::skipBytes($this->file, 6);//Reserved bytes
        $this->dataReferenceIndex = \Flare\Common\ByteUtils::readUnsignedShort($this->file);
    }
    
    public function setDataReferenceIndex($index){
        $this->dataReferenceIndex = $index;
    }
    
}
