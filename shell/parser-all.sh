#!/bin/bash

date
echo "[---] START. All parsers."
sh parser-items-hifi.sh

sh parser-news-hifi.sh
sh parser-news-rec.sh

sh parser-reviews-hifi.sh
sh parser-reviews-rec.sh

sh parser-rec-media.sh

# sh parser-items-dba.sh

echo "[---] END. All parsers."