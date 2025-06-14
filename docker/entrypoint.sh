#!/bin/sh
set -e

echo "Iniciando supervisord, PHP-FPM e Nginx..."

# Iniciar o Supervisor
supervisord -c /etc/supervisor/supervisord.conf

# Iniciar PHP-FPM e Nginx no mesmo container
php-fpm &
nginx -g "daemon off;"
