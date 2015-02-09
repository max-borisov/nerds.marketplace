#!/bin/bash

date
echo "[---] START. All parsers."
sh parser-items-hifi.sh

sh parser-news-hifi.sh
sh parser-news-rec.sh

sh parser-reviews-hifi.sh
sh parser-reviews-rec.sh

echo "[---] END. All parsers."