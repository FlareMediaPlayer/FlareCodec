<?php

namespace Isolator\Boxes;

/**
 * Description of Mdia
 *
 * @author Brian Parra
 */
class Mdia extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::MDIA;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
    }

    public function getMinfBox() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Minf) {
                return $box;
            }
        }
        return null;
    }

    public function isAudioTrack() {

        $minf = $this->getMinfBox();
        if ($minf != null) {
            return $minf->isAudioTrack();
        } else {
            return false;
        }
    }

}
