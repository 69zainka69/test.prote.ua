# Prote.ua

Prote.ua web application

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development purposes.

### Prerequisites

What things you need to install the software and how to install them

Install and configure php
```
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update -yqq

sudo apt-get install -yqq php7.2 \
    php7.2-cli php7.2-fpm php7.2-mysql php7.2-json php7.2-curl php7.2-gd php7.2-intl php7.2-zip php7.2-xml \
    php7.2-mbstring php7.2-soap php7.2-memcache php7.2-memcached php7.2-opcache

sudo sed -i 's,^short_open_tag .*$,short_open_tag = On,' /etc/php/7.2/fpm/php.ini
sudo sed -i 's,^max_execution_time .*$,max_execution_time = 600,' /etc/php/7.2/fpm/php.ini
sudo sed -i 's,^memory_limit .*$,memory_limit = 1024M,' /etc/php/7.2/fpm/php.ini
sudo sed -i 's,^post_max_size .*$,post_max_size = 20M,' /etc/php/7.2/fpm/php.ini
sudo sed -i 's,^upload_max_filesize .*$,upload_max_filesize = 20M,' /etc/php/7.2/fpm/php.ini
sudo sed -i 's,^max_file_uploads .*$,max_file_uploads = 100,' /etc/php/7.2/fpm/php.ini

sudo apt-get install nginx
sudo cp nginx/sample.conf /etc/nginx/conf.d/prote.ua.conf

sudo service php7.2-fpm restart
sudo service nginx restart
```

### Installing

Create configs
```
cp config.sample.php config.php
cp adminka/config.sample.php adminka/config.php
```

### Running the application

Launch application with default host - localhost:8080
