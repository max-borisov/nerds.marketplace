#!/bin/bash

echo "[----------] BEGIN. RECORDERE NEWS parser script."

cd ../
php yii parserrec/news >> runtime/parser.log

echo "[----------] END. RECORDERE NEWS parser script."