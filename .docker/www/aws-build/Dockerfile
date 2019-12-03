FROM git.heyday.net.nz:4567/worksafe/risk-project/base-www:latest

MAINTAINER Heyday <dev@heyday.co.nz>

ARG RISK_APP_VERSION=latest

## COPY CODE INSIDE OF IMAGE
COPY . /var/www/html

RUN rm -Rf /var/www/html/.docker \
    /var/www/html/.git \
    /var/www/html/.env \
    /var/www/html/.env.example \
    /var/www/html/.idea \
    /var/www/html/.editorconfig \
    /var/www/html/index.nginx-debian.html

RUN cd /var/www/html \
    && composer install --no-dev -o

RUN chown root:www-data -R /var/www/html/storage/
RUN chmod 775 -R /var/www/html/storage

COPY .docker/www/aws-build/.env.test /var/www/html/.env
RUN cd /var/www/html \
    && php artisan key:generate \
    && echo "APP_VERSION=$RISK_APP_VERSION" >> /var/www/html/.env

ENTRYPOINT ["/opt/startup/init_container.sh"]


