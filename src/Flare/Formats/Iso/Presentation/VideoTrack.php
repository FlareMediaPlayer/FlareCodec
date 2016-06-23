<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flare\Formats\Iso\Presentation;

/**
 * Description of VideoTrack
 *
 * @author Brian Parra
 */
class VideoTrack extends Track{
    //put your code here
    public function __construct($movie) {
        $this->trackType = self::$trackTypes[1];
        $this->movie = $movie;
        $this->handlerType = \Flare\Formats\Iso\Boxes\Hdlr::VIDE;
    }
}
