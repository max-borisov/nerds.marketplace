#!/bin/bash

echo "[----------] BEGIN. HIFI NEWS parser script."

cd ../
php yii hifi4all/news >> runtime/parser.log

echo "[----------] END. HIFI NEWS parser script."