#!/bin/bash

echo "[----------] BEGIN. HIFI REVIEWS parser script."

cd ../
php yii parserhifi/reviews >> runtime/parser.log

echo "[----------] END. HIFI REVIEWS parser script."