# Isolator-PHP
Php Library for Iso file utilities
www.isolator.io (coming soon!)

Clone and open the sample project. Can now find and ouput box structure of an Iso complient file.
Currently only tested on mp4. Currently working on extracting all the internal data of the boxes.


Check out the sample output

>sample.mp4

-->ftyp
-->free
-->mdat
-->mdat
-->moov
---->mvhd
---->trak
------>tkhd
------>edts
-------->elst
------>mdia
-------->mdhd
-------->hdlr
-------->minf
---------->dinf
------------>dref
---------->stbl
------------>stsd
------------>stts
------------>stsc
------------>stsz
------------>stco
---->trak
------>tkhd
------>edts
-------->elst
------>mdia
-------->mdhd
-------->hdlr
-------->minf
---------->smhd
---------->dinf
------------>dref
---------->stbl
------------>stsd
------------>stts
------------>stsc
------------>stsz
------------>stco
