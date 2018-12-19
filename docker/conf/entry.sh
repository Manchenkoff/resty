#!/bin/bash
service supervisor start

echo "Starting Apache..."
apache2ctl -k start -D FOREGROUND