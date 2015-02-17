#!/bin/bash

echo "[----------] BEGIN. HIFI NEWS parser script."

cd ../
php yii parserhifi/news >> runtime/logs/parser.log

echo "[----------] END. HIFI NEWS parser script."