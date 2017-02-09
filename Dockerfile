FROM ubuntu:latest

MAINTAINER Jose Luis Cardosa <jlcardosa@gmail.com>

ENV DEBIAN_FRONTEND=noninteractive

RUN locale-gen en_GB.UTF-8
RUN export LANG=en_GB.UTF-8
RUN apt-get update
RUN apt-get install -y software-properties-common
RUN apt-get install -y language-pack-en-base
RUN LC_ALL=en_GB.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update

# Install Apache Server
RUN apt-get -y install apache2
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN mkdir /var/www/local.refugeelife
ADD cms.refugeelife.com.conf /etc/apache2/sites-available/cms.refugeelife.com.conf
RUN a2dissite 000-default.conf
RUN a2ensite cms.refugeelife.com.conf

# Install Serveral extra tools
RUN apt-get -y install
    curl \
    composer \
    nodejs \
    npm \
    imagemagick \
    vim \
    git \
    wget \
    zip \
    unzip

# Install php7
RUN apt-get -y install libapache2-mod-php7.0 \
    php7.0 \
    php7.0-cli \
    php7.0-mbstring \
    php7.0-mysql \
    php-apcu \
    php-pear \
    php7.0-dev \
    php7.0-json \
    php7.0-curl \
    php7.0-intl \
    php7.0-zip \
    php-xml \
    php5.6-xml \
    php7.0-xml

RUN a2enmod headers
RUN a2enmod rewrite

RUN ln -s /usr/bin/nodejs /usr/bin/node
RUN npm install -g bower

# RUN pecl channel-update pecl.php.net
# RUN pecl install mongodb
# RUN echo "extension=mongodb.so" >> /etc/php/7.0/apache2/php.ini
# RUN echo "extension=mongodb.so" >> /etc/php/7.0/cli/php.ini
# RUN apt-get install -y php7.0-bcmath

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
RUN ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR

VOLUME /var/www/local.refugeelife
VOLUME /var/log/httpd

WORKDIR /var/www/local.refugeelife

EXPOSE 80

ENTRYPOINT ["/usr/sbin/apache2"]
CMD ["-D", "FOREGROUND"]
