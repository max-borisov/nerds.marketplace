#!/bin/bash

echo "[----------] BEGIN. RECORDERE MEDIA parser script."

cd ../
php yii parserrec/media >> runtime/logs/parser.log

echo "[----------] END. RECORDERE MEDIA parser script."