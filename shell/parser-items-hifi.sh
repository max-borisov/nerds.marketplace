#!/bin/bash

echo "[----------] BEGIN. HIFI ITEMS parser script."

cd ../
php yii hifi4all/items >> runtime/parser.log

echo "[----------] END. HIFI ITEMS parser script."