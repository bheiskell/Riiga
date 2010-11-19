#!/bin/sh
convert -quality 80 -depth 4 -type TrueColorMatte -interlace JPEG \
  original.png riiga.jpg
