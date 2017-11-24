FROM ubuntu:16.04
MAINTAINER Samundra Shrestha <samundra.shr@gmail.com>
ENV LANG C.UTF-8
ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Asia/Bangkok /etc/localtime

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys B97B0AFCAA1A47F044F244A07FCC7D46ACCC4CF8

RUN apt-get update && apt-get install -y software-properties-common \
    && add-apt-repository ppa:ondrej/php -y \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C

# PHP Development Tools
RUN apt-get update && apt-get -y install -q \
   php7.0-fpm \
   php7.0-cli \
   php7.0-dev \
   php7.0-gd \
   php7.0-imap \
   php7.0-intl \
   php7.0-json \
   php7.0-mcrypt \
   php7.0-mysql \
   php7.0-mbstring \
   php7.0-ldap \
   php7.0-zip \
   php7.0-xml \
   php7.0-pgsql \
   php7.0-curl \
   php-pear \
   php7.0-dev

# Development Tools
RUN apt-get update && apt-get install -y -q \
   supervisor nginx unzip git curl cron sudo mysql-client-5.7 && \
   apt-get clean

# Comopser
RUN curl -sS https://getcomposer.org/installer|\
  php -- --install-dir=/usr/local/bin --filename=composer && \
  chmod +x /usr/local/bin/composer

# Nodejs
RUN curl -sL https://deb.nodesource.com/setup_6.x -o nodesource_setup.sh && \
     bash nodesource_setup.sh && \
     apt-get install -y nodejs && \
     rm nodesource_setup.sh && \
     npm install -g yarn

# Vagrant Configurations
RUN export uid=1000 gid=1000 \
    && mkdir -p /home/vagrant \
    && echo "vagrant:x:${uid}:${gid}:vagrant,,,:/home/vagrant:/bin/bash" >> /etc/passwd \
    && echo "vagrant:x:${uid}:" >> /etc/group \
    && echo "vagrant ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/vagrant \
    && chmod 0400 /etc/sudoers.d/vagrant \
    && chown ${uid}:${gid} -R /home/vagrant \
    && usermod -g www-data vagrant

# misc
RUN apt-get install -y bash-completion vim
ADD .bashrc /home/vagrant/.bashrc

ENV HOME /home/vagrant
USER vagrant

WORKDIR /vagrant

VOLUME /vagrant
CMD /bin/bash
