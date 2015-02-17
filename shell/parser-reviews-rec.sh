#!/bin/bash

echo "[----------] BEGIN. RECORDERE REVIEWS parser script."

cd ../
php yii parserrec/reviews >> runtime/logs/parser.log

echo "[----------] END. RECORDERE REVIEWS parser script."