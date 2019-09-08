FROM ubuntu:latest
MAINTAINER Artem Manchenkov <artyom@manchenkoff.me>

### Update repositories
RUN apt-get update && apt-get upgrade -y

### Install Apache
RUN apt-get install -y apache2 apache2-utils curl gnupg wget

### Enable URL rewriting and HTTPS support
RUN a2enmod rewrite
RUN a2enmod ssl

### Set the server local time zone
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

### Install Node.js | npm
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
    && apt-get install -y nodejs

### Install Git, Python 3, Perl 5, PHP 7, 'nano' editor
RUN apt-get update && \
    apt-get install -y \
    git python3 perl \
    php nano acl

### PHP Extensions
RUN apt-get update && \
    apt-get install -y \
    php-pdo php-pdo-mysql \
    php-pdo-pgsql php-pdo-sqlite \
    php-mbstring php-tokenizer \
    php-xml php-simplexml php-zip \
    php-opcache php-iconv php-intl \
    php-json php-gd php-ctype php-oauth \
    php-mongodb php-xdebug php-redis \
    php-apcu php-imagick php-tidy \
    php-memcached php-ftp php-imap \
    php-exif php-sqlite3 php-curl php-memcache

### PHP Composer, Supervisor
RUN apt-get install -y composer supervisor

### Expose ports [Apache, Apache HTTPS/SSL]
EXPOSE 80 443

### Set PHP configrations
ADD ./php/php.ini /etc/php/7.2/apache2/php.ini
ADD ./php/xdebug.ini /etc/php/7.2/mods-available/xdebug.ini

### Set Apache configrations
ADD ./apache/apache2.conf /etc/apache2/apache2.conf
ADD ./apache/ports.conf /etc/apache2/ports.conf

### Set Supervisor configrations
COPY ./supervisor /etc/supervisor/conf.d

### Remove previous Apache's hosts files
RUN rm -R /etc/apache2/sites-enabled/* /etc/apache2/sites-available/* /var/www/*
COPY ./apache/hosts /etc/apache2/sites-enabled

### Generate SSL certificate
RUN mkdir /etc/apache2/ssl
RUN openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj \
    "/C=RU/ST=Moscow-State/L=Moscow/O=Manchenkov/CN=localhost" \
    -keyout /etc/apache2/ssl/ssl.key -out /etc/apache2/ssl/ssl.crt

### Set default entry directory
WORKDIR /var/www

### Base init command (without overload)
ADD ./entry.sh /usr/local/bin/start-container
ENTRYPOINT ["/bin/bash", "/usr/local/bin/start-container"]

### Base command (with overload)
#CMD some-command

