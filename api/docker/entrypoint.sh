#!/bin/bash

# Inicia o Nginx
service nginx start

# Inicia o PHP-FPM em background
php-fpm &

# Inicia o worker da fila back_emails
php artisan queue:work --queue=back_emails
