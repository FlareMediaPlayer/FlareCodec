<?php

/*
 * The MIT License
 *
 * Copyright 2016 Brian Parra.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Isolator\Boxes\SampleEntries;

/**
 * Description of Mp4a
 *
 * @author Brian Parra
 */
class Mp4a extends \Isolator\Boxes\SampleEntries\AudioSampleEntry {

    //put your code here
    private $esdBox;

    function __construct($file) {

        $this->boxType = \Isolator\Box::MP4A;
        parent::__construct($file);
        
    }

    public function loadData() {
        parent::loadData();
        
    }

    public function getBoxDetails() {
        
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Data Reference Index"] = $this->dataReferenceIndex;
        $details["Channel Count"] = $this->channelCount;
        $details["Sample Size"] = $this->sampleSize;
        $details["Sample Rate"] = $this->sampleRate;

        


        return $details;
    }
}
