#!/bin/bash

echo "[----------] BEGIN. RECORDERE REVIEWS parser script."

cd ../
php yii parserrec/reviews >> runtime/parser.log

echo "[----------] END. RECORDERE REVIEWS parser script."