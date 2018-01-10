#!/bin/bash

wget -P /tmp http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.tar.gz

cd /tmp && tar -xvzf GeoLite2-City.tar.gz

path=`find /tmp -type d -name "GeoLite*"`

mv $path"/GeoLite2-City.mmdb" /usr/share/GeoIP

rm -rf $path
rm /tmp/GeoLite2-City.tar.gz
