#!/bin/bash

CHARSET=utf8
DBNAME=nerds
HOST=localhost
USER=$NERDS_DB_USER
PASSWD=$NERDS_DB_PASSWORD

if [ "$NERDS_DB_USER" = "" ] || [ "$NERDS_DB_PASSWORD" = "" ]
then
    echo 'Please, check ENV variables for DB user and password.'
    exit
fi

#if [ "$1" = "dev" ]
#then
#    FILENAME=/Volumes/Macintosh HD_2/projects/marketplace.nerds/basic/backup/
#elif [ "$1" = "prod" ]
#then
#    FILENAME=/var/www/marketplace.vardumper.com/backup/
#else
#    echo 'Incorrect env'
#    exit
#fi

FILENAME=../backup/

echo "[----------][`date +%F--%H-%M`] Run the backup script..."
#NAME=$FILENAME-`date +%F_%H-%M-%S`
NAME=$FILENAME"dump"_`date +%F_%H:%M:%S`
#MySQL dump
mysqldump --user=$USER --host=$HOST --password=$PASSWD --default-character-set=$CHARSET --routines $DBNAME > $NAME.sql
# tar -czvf cargo.tar.gz cargo_backup-2013-10-16_10-36-51.sql
echo "[----------][`date +%F--%H-%M`] Backup script finished."

#echo "[----------] GitHub commit START."
#cd /var/www/ontris.vardumper.com
#git pull
#git add protected/data/backup/dev
#git commit -m "DB auto backup dev`date +%F %H:%M:%S`" protected/data/backup/dev
#git push
#echo "[----------] GitHub commit END"
