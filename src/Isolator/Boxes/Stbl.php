<?php

namespace Isolator\Boxes;

/**
 * Description of Dref
 *
 * @author Brian Parra
 */
class Stbl extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::STBL;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;


        $this->loadChildBoxes();
    }

    public function isAudioTrack() {

        return $this->getStsdBox()->isAudioTrack();
        
    }

    public function getStsdBox() {
        
        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Stsd) {
                return $box;
            }
        }
        return null;
    }

}
