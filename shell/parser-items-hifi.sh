#!/bin/bash

echo "[----------] BEGIN. HIFI ITEMS parser script."

cd ../
php yii parserhifi/items >> runtime/logs/parser.log

echo "[----------] END. HIFI ITEMS parser script."