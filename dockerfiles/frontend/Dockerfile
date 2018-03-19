FROM ubuntu:16.04
MAINTAINER Samundra Shrestha <samundra.shr@gmail.com>
ENV LANG C.UTF-8
ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Asia/Bangkok /etc/localtime

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys B97B0AFCAA1A47F044F244A07FCC7D46ACCC4CF8

RUN apt-get update && apt-get install -y software-properties-common \
    && add-apt-repository ppa:ondrej/php -y \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C

RUN apt-get update && apt-get -y install -q supervisor nginx unzip git curl cron \
   php7.1 \
   php7.1-fpm \
   php7.1-cli \
   php7.1-gd \
   php7.1-imap \
   php7.1-intl \
   php7.1-json \
   php7.1-mcrypt \
   php7.1-mysql \
   php7.1-mbstring \
   php7.1-ldap \
   php7.1-zip \
   php7.1-xml \
   php7.1-pgsql \
   php7.1-curl && \
   apt-get clean

RUN curl -sS https://getcomposer.org/installer|\
  php -- --install-dir=/usr/local/bin --filename=composer && \
  chmod +x /usr/local/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_6.x -o nodesource_setup.sh && \
     bash nodesource_setup.sh && \
     apt-get install nodejs && \
     rm nodesource_setup.sh && \
     npm install -g yarn

WORKDIR /var/www

ADD conf/php.ini /etc/php/7.0/fpm/99-custom.ini
ADD conf/www.conf /etc/php/7.0/fpm/pool.d/www.conf
ADD conf/supervisord.conf /etc/supervisord.conf
ADD conf/nginx.conf /etc/nginx/nginx.conf
ADD conf/env.devel /var/www/.env

RUN mkdir /var/run/php/
RUN useradd -u 1000 1000

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
