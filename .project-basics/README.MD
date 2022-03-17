# Welcome to bedrock Bedrock Project


Requirement
-----------

You should export the following environment variables
for build the php docker image and sets the uid and gui of apache user.

```bash
export DOCKER_WWW_DATA_GID=$(id -g)
export DOCKER_WWW_DATA_UID=$(id -u)
```

You could copy/paste into `~/.bashrc` or `~/.zshrc`


Git Submodules
--------------

After cloning the project, init submodules like this:

```bash
git submodule sync --recursive
git submodule update --init --recursive
```

Hosts
-----

##### _Classic Way_

```bash
127.0.0.1 bedrock.docker
```

```bash
docker-compose -f docker-compose.yml -f docker-compose-local.yml up -d
```

* [http://bedrock.docker]()
* [http://localhost:8080]()


##### _Traefik_

/etc/hosts :

```bash
127.0.0.1 bedrock.docker pma.bedrock.docker mail.bedrock.docker
```

* [http://bedrock.docker]()
* [http://pma.bedrock.docker]()
* [http://mail.bedrock.docker]() *Mailhog*

Connect to php
------
```bash
docker-compose exec --user=www-data php /bin/bash
```

Composer Gitlab oauth
------
```bash
composer config gitlab-oauth.gitlab.com XXXXXXXXXXXXX
```
