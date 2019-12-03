FROM ubuntu:18.04

MAINTAINER Heyday <dev@heyday.co.nz>

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=Auckland/Pacific

RUN apt-get update \
	&& apt-get install -y nginx curl ufw net-tools sudo zip unzip vim nano git software-properties-common supervisor sqlite3 \
	&& add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
	&& apt-get install -y php7.3-fpm php7.3-cli php7.3-gd php7.3-mysql php7.3-intl locales \
	php7.3-imap php-redis php7.3-mbstring php7.3-xml php7.3-curl php7.3-bcmath php7.3-zip \
	&& locale-gen en_US.UTF-8 \
	&& php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
	&& mkdir /run/php \
	&& apt-get remove -y --purge software-properties-common \
	&& apt-get -y autoremove \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
	&& echo "daemon off;" >> /etc/nginx/nginx.conf

COPY ssl-params.conf /etc/nginx/snippets/ssl-params.conf
COPY basic_auth.conf /etc/nginx/snippets/basic_auth.conf
COPY default.conf /etc/nginx/sites-available/default
COPY php-fpm.conf /etc/php/7.3/fpm/php-fpm.conf
COPY php.ini /etc/php/7.3/fpm/php.ini 
COPY .htpasswd /etc/nginx/.htpasswd
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf


## MAKE SURE APPLICATION SETTINGS ARE AVAILABLE IN APP
RUN sed -i 's/;clear_env = no/clear_env = no/g' /etc/php/7.3/fpm/pool.d/www.conf

# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log

COPY init_container.sh /opt/startup/
RUN chmod 755 /opt/startup/init_container.sh

EXPOSE 80 443

WORKDIR /var/www/html
