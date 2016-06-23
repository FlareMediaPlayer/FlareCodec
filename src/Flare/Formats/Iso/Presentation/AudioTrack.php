<?php

/**
 * Description of AudioTrack
 *
 * @author Brian Parra
 */

namespace Flare\Formats\Iso\Presentation;

class AudioTrack extends Track {



    public function __construct($movie) {
        $this->handlerType = \Flare\Formats\Iso\Boxes\Hdlr::SOUN;
        $this->trackType = self::$trackTypes[1];
        $this->fullSampleMap = [];
        $this->sampleSizeTable = [];
        $this->deltaTable = [];
        $this->sampleToChunkTable = [];
        $this->chunkOffsetTable = [];
        $this->expandedDataTable = [];

        $this->movie = $movie;
        $this->file = $this->movie->getFile();
        //We have to build an entire trak, then copy details over if available
        //For now this one is an audio track

        $this->trak = new \Flare\Formats\Iso\Boxes\Trak($this->file);


        $this->tkhd = new \Flare\Formats\Iso\Boxes\Tkhd($this->file);
        $this->tkhd->setVolume(1);
        $this->trak->addBox($this->tkhd);
        
        $this->edts = new \Flare\Formats\Iso\Boxes\Edts($this->file);
        $this->trak->addBox($this->edts);
        
        $this->elst = new \Flare\Formats\Iso\Boxes\Elst($this->file);
        $this->edts->addBox($this->elst);

        $this->mdia = new \Flare\Formats\Iso\Boxes\Mdia($this->file);
        $this->trak->addBox($this->mdia);

        $this->mdhd = new \Flare\Formats\Iso\Boxes\Mdhd($this->file);
        $this->mdia->addBox($this->mdhd);

        $this->hdlr = new \Flare\Formats\Iso\Boxes\Hdlr($this->file);
        $this->hdlr->setHandlerType(\Flare\Formats\Iso\Boxes\Hdlr::SOUN);
        $this->mdia->addBox($this->hdlr);

        $this->minf = new \Flare\Formats\Iso\Boxes\Minf($this->file);
        $this->mdia->addBox($this->minf);

        $this->smhd = new \Flare\Formats\Iso\Boxes\Smhd($this->file);
        $this->minf->addBox($this->smhd);

        $this->dinf = new \Flare\Formats\Iso\Boxes\Dinf($this->file);
        $this->minf->addBox($this->dinf);

        $this->dref = new \Flare\Formats\Iso\Boxes\Dref($this->file);
        $this->dinf->addBox($this->dref);

        $this->url = new \Flare\Formats\Iso\Boxes\Url($this->file);
        $this->dref->addBox($this->url);

        $this->stbl = new \Flare\Formats\Iso\Boxes\Stbl($this->file);
        $this->minf->addBox($this->stbl);

        $this->stsd = new \Flare\Formats\Iso\Boxes\Stsd($this->file);
        $this->stbl->addBox($this->stsd);

        $this->sampleEntry = new \Flare\Formats\Iso\Boxes\SampleEntries\Mp4a($this->file);
        $this->sampleEntry->setSampleRate($this->sampleRate);
        $this->sampleEntry->setDataReferenceIndex(1);
        
        $this->esds = new \Flare\Formats\Iso\Boxes\Esds($this->file);
        $this->sampleEntry->addBox($this->esds);
        
        $this->stsd->addBox($this->sampleEntry);

        $this->stts = new \Flare\Formats\Iso\Boxes\Stts($this->file);
        $this->stbl->addBox($this->stts);

        $this->stsc = new \Flare\Formats\Iso\Boxes\Stsc($this->file);
        $this->stbl->addBox($this->stsc);

        $this->stsz = new \Flare\Formats\Iso\Boxes\Stsz($this->file);
        $this->stbl->addBox($this->stsz);

        $this->stco = new \Flare\Formats\Iso\Boxes\Stco($this->file);
        $this->stbl->addBox($this->stco);
    }


}
