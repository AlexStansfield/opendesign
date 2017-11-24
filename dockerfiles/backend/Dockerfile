FROM opendesign/frontend:1.0
MAINTAINER Samundra Shrestha <admin@samundra.com.np>
ENV LANG C.UTF-8
ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Asia/Bangkok /etc/localtime

WORKDIR /var/www

ADD conf/php.ini /etc/php/7.0/fpm/99-custom.ini
ADD conf/www.conf /etc/php/7.0/fpm/pool.d/www.conf
ADD conf/nginx.conf /etc/nginx/nginx.conf
ADD conf/env.devel /var/www/.env

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
