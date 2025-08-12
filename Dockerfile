# Set the php version you need for your project
FROM php:8.4-fpm

# To be able to install the ODBC driver (msodbcsql18), see Debian tab:
# https://learn.microsoft.com/en-us/sql/connect/odbc/linux-mac/installing-the-microsoft-odbc-driver-for-sql-server
RUN curl -sSL -O https://packages.microsoft.com/config/debian/$(grep VERSION_ID /etc/os-release | cut -d '"' -f 2 | cut -d '.' -f 1)/packages-microsoft-prod.deb && \
dpkg -i packages-microsoft-prod.deb && \
rm packages-microsoft-prod.deb

# Set the php extensions you need for your project
RUN apt update && \
    ACCEPT_EULA=Y apt install -y libfreetype-dev libjpeg62-turbo-dev libpng-dev libzip-dev zip unixodbc-dev msodbcsql18 && \
    pecl install xdebug sqlsrv pdo_sqlsrv && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install mysqli pdo pdo_mysql gd exif zip && \
    docker-php-ext-enable xdebug sqlsrv pdo_sqlsrv
