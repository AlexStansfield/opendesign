#!/bin/bash
CURRENT_DIR=$(pwd)
cp docker-compose.yml.dist docker-compose.yml

echo "Building docker containers"

#docker network rm opendesign && docker volume rm opendesign-data
docker network create opendesign && docker volume create opendesign-data
docker-compose build
(cd dockerfiles && docker build --rm -t opendesign/development:1.0 dev/)
docker-compose up -d
wait

## Run make in the dev container
cd ${CURRENT_DIR} && docker run -t --rm -v $(pwd):/vagrant --net=opendesign opendesign/development:1.0 make install
