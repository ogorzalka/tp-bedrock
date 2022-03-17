FROM php:7.4-fpm

#REPOS
RUN apt-get update && apt-get install -y gnupg && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    curl -sS https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    echo 'deb https://deb.nodesource.com/node_12.x buster main' > /etc/apt/sources.list.d/nodesource.list && \
    apt remove -y gnupg
    
RUN apt-key adv --refresh-keys --keyserver keyserver.ubuntu.com

# PHP Curl layer
RUN apt-get update && \
    apt-get -y install git zip wget vim net-tools iproute2 libicu-dev libzip-dev libxslt-dev libpng-dev libjpeg-dev libfreetype6-dev mariadb-client && \
    docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ && \
    docker-php-ext-install bcmath intl zip pdo_mysql mysqli xsl gd exif soap sockets && \
    apt-get install -y nodejs yarn && \
    yarn global add grunt grunt-cli grunt-svgmin grunt-svgstore

COPY scripts/install-composer.sh /docker/install-composer.sh
RUN sh /docker/install-composer.sh && \
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp
    
# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

#Setup uid & gid layer
ARG DOCKER_WWW_DATA_UID
ARG DOCKER_WWW_DATA_GID

RUN echo "Docker user uid and gid is ${DOCKER_WWW_DATA_UID}:${DOCKER_WWW_DATA_GID}"
RUN usermod -u ${DOCKER_WWW_DATA_UID} www-data && \
    groupmod -g ${DOCKER_WWW_DATA_GID} www-data

RUN mkdir /var/www/.yarnrc && chown ${DOCKER_WWW_DATA_UID}:${DOCKER_WWW_DATA_GID} /var/www/.yarnrc

# Composer layer
USER www-data

RUN composer config -a -g github-oauth.github.com c667cc9cff9d70c479d36c5df63c33db8e7f1ab0 && \
    composer config -a -g http-basic.repo.magento.com 845dbde603b74e24fa2d094ec4eecc5d 4a07c902771d6ec56df5893cdaa8b531 && \
    composer config -a -g http-basic.git.nexylan.net ci-and-deploy eCkskKaL84qGj9kQw67s && \
    composer config -a -g gitlab-oauth.gitlab.com bb96c73bc801cb3b944455bdfa8ce44f195777bd83c25d6dd4362f092b0724a4
