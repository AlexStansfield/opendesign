FROM ubuntu:16.04
MAINTAINER Samundra Shrestha <samundra.shr@gmail.com>
ENV LANG C.UTF-8
ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Asia/Bangkok /etc/localtime

RUN apt-get update && apt-get -y install curl
RUN apt-get -y install -q supervisor nginx unzip git curl cron
RUN apt-get clean

RUN curl -sL https://deb.nodesource.com/setup_6.x -o nodesource_setup.sh && \
     bash nodesource_setup.sh && \
     apt-get -y install nodejs && \
     rm nodesource_setup.sh && \
     npm install -g yarn

WORKDIR /var/www
ADD conf/supervisord.conf /etc/supervisord.conf
ADD conf/nginx.conf /etc/nginx/nginx.conf
RUN useradd -u 1000 1000

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
