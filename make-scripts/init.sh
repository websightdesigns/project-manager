#!/bin/bash

# initialize app/tmp and expected subdirectories; bounce apache

rm -rf app/tmp

mkdir -m 756 app/tmp

echo "Created clean app/tmp"

cd app/tmp

# ensure temp directories exist
mkdir -p -m 756 cache cache/default cache/cores  cache/models \
  cache/views cache/pages cache/locations cache/permanent \
  cache/persistent logs sessions
  
touch logs/error.log

echo "Created app/tmp directories."

echo "Enter user:group setting, e.g. apache:apache. CentOS uses apache:apache"
read CHOWNINFO

chown -R $CHOWNINFO .
chmod -R g+ws .

echo; echo "Created directories with $CHOWNINFO"

ls -l .
cd ..

#set owner for webroot
chmod -R 644 webroot
#Set permissions, so CentOS 6 is good.
find webroot -type d -exec chmod ugo+xs {} \;
find webroot/img -type d -exec chmod o+x {} \;
find webroot/css -type d -exec chmod o+x {} \;
find webroot/js -type d -exec chmod o+x {} \;

echo; echo "Restarting Apache"

type apachectl &>/dev/null && apachectl graceful || /etc/init.d/httpd graceful
