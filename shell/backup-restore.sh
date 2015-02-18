#!/bin/bash

# $1 - database name
# $2 - path to dump file

if [ "$1" = "" ] || [ "$2" = "" ]
then
    echo 'Please, set database name and dump file.'
    exit
fi

mysql -h localhost -u $NERDS_DB_USER -p$NERDS_DB_PASSWORD $1 < $2 
