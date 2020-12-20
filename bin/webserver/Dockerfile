#FROM php:7.1.20-apache

#RUN apt-get -y update --fix-missing
#RUN apt-get upgrade -y

# Install useful tools
#RUN apt-get -y install apt-utils nano wget dialog

# Install important libraries
#RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip

# Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
#RUN pecl install xdebug-2.5.0
#RUN docker-php-ext-enable xdebug

# Other PHP7 Extensions

#RUN apt-get -y install libmcrypt-dev
#RUN docker-php-ext-install mcrypt

#RUN apt-get -y install libsqlite3-dev libsqlite3-0 mysql-client
#RUN docker-php-ext-install pdo_mysql 
#RUN docker-php-ext-install pdo_sqlite
#RUN docker-php-ext-install mysqli

#RUN docker-php-ext-install curl
#RUN docker-php-ext-install tokenizer
#RUN docker-php-ext-install json

#RUN apt-get -y install zlib1g-dev
#RUN docker-php-ext-install zip

#RUN apt-get -y install libicu-dev
#RUN docker-php-ext-install -j$(nproc) intl

#RUN docker-php-ext-install mbstring

#RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
#RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
#RUN docker-php-ext-install -j$(nproc) gd

# Enable apache modules
#RUN a2enmod rewrite headers
FROM php:7.1.20-apache
RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y
# Install tools & libraries
RUN apt-get -y install apt-utils nano wget dialog \
		build-essential git curl libcurl3 libcurl3-dev zip ssmtp
RUN echo $'root=camagru.ymanyani@gmail.com \n\
	UseSTARTTLS=YES \n\
	mailhub=smtp.gmail.com:587 \n\
	AuthUser=camagru.ymanyani@gmail.com.com \n\
	AuthPass=<You05Yazid2000/> \n\
	rewriteDomain= \n\
	FromLineOverride=YES' >> /etc/ssmtp/ssmtp.conf
RUN echo 'root:camagru.ymanyani@gmail.com:smtp.gmail.com:587 \
	username:camagru.ymanyani@gmail.com:smtp.gmail.com:587' >> /etc/ssmtp/revaliases
# Itall important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip \
	libmcrypt-dev libsqlite3-dev libsqlite3-0 mysql-client zlib1g-dev \
	libicu-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev
# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# PHP Extensions
RUN pecl install xdebug-2.5.5 \
	&& docker-php-ext-enable xdebug \
	&& docker-php-ext-install mcrypt \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install pdo_sqlite \
	&& docker-php-ext-install mysqli \
	&& docker-php-ext-install curl \
	&& docker-php-ext-install tokenizer \
	&& docker-php-ext-install json \
	&& docker-php-ext-install zip \
	&& docker-php-ext-install -j$(nproc) intl \
	&& docker-php-ext-install mbstring \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd \
	&& pecl install redis \
	&& docker-php-ext-enable redis
# Enable apache modules
RUN a2enmod rewrite headers
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
