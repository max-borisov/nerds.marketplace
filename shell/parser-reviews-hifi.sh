#!/bin/bash

echo "[----------] BEGIN. HIFI REVIEWS parser script."

cd ../
php yii hifi4all/reviews >> runtime/parser.log

echo "[----------] END. HIFI REVIEWS parser script."