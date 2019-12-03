FROM git.heyday.net.nz:4567/heyday/docker/ubuntu18-nginx-php73:latest

COPY php.ini /etc/php/7.3/fpm/php.ini 

RUN sed -i 's/website.local/scaventum.local/g' /etc/nginx/sites-available/default

CMD "/usr/bin/supervisord"
