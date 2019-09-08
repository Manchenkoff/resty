#!/bin/bash
# Setup aliases
echo "Setting aliases [OK]"
echo "alias codecept='/var/www/vendor/bin/codecept'" >> ~/.bashrc
echo "alias dep='/var/www/vendor/bin/dep'" >> ~/.bashrc

# Start supervisor daemon
echo "Starting supervisor [OK]"
service supervisor start @> /dev/null

# Start apache2 daemon
echo "Starting apache [OK]"
rm -f /var/run/apache2/apache2.pid
apache2ctl -k start -D FOREGROUND

