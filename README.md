# opendesign
Open Design Platform

## Backend Information
dev url : http://backend.dev

## Frontend Information
dev url: http://frontend.dev

## Database Credentials
username : opendesign
password : opendesign
database : opendesign

## Docker Dev Box Setup
Follow the instructions provided below for docker based development setup.

Once project is cloned.

### Setup
```bash
$ ./init.sh
```

### Inside the Dev Box
```bash
$ make install
$ make test
```

### Add host files
```bash
127.0.0.1 frontend.dev
127.0.0.1 backend.dev
```

### Connect to other boxes from dev box.

From project root directory, use this command
```bash
$ docker run -ti --rm -v $(pwd):/vagrant --net=opendesign opendesign/development:1.0
```

For simplicity, you can put this command into the alias and source it in ```.bashrc``` as
`alias in-backend="docker run -ti --rm -v /projects/opendesign:/vagrant --net=opendesign opendesign/development:1.0"`

Then you can simply execute as `in-backend`.

