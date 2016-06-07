<?php

namespace Isolator\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Trak extends \Isolator\Box {

    private $mdia; //cache a direct reference to the Mdia media header box

    function __construct($file) {

        $this->boxType = \Isolator\Box::TRAK;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
    }

    public function isAudioTrack() {
        $mdia = $this->getMdiaBox();
        if ($mdia != null) {
            return $mdia->isAudioTrack();
        } else {
            return false;
        }
    }

    public function getMdiaBox() {
        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Mdia) {
                return $box;
            }
        }
        return null;
    }

    public function getTrackID() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Tkhd) {
                return $box->getTrackID();
            }
        }
    }

}
