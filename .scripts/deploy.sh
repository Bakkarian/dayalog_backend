#!/bin/bash
# Terminate execution if any command fails
set -e

<< 'AUTHOR'
    {
        description: A script to automatically deploy the Dayalog on linux with zero downtime
    }
AUTHOR

#Terminal color settings
red="\e[31m"
green="\e[32m"
yellow="\e[33m"
blue="\e[34m"
reset="\e[0m"

echo -e "${blue} Dayalog Deployment started ...${reset}"

#use current timestamp to define new directory for the update
TAG=$(date "+%Y-%m-%d_%H-%I-%S")
PHP_VERSION=8.1

GIT_REPO=git@github.com:Bakkarian/dayalog_backend.git
BASE_DIR=./test
RELEASE_DIR=$BASE_DIR/releases/$TAG

mkdir -p "$RELEASE_DIR"

cd "$RELEASE_DIR"

#pull repo with latest changes
echo -e "${yellow}cloning from github ...${reset}"
git clone $GIT_REPO .

#checkout the main branch
git checkout main

# Set file permissions for the webserver
find . -type f -exec chmod 664 {} \;
find . -type d -exec chmod 775 {} \;

chmod -R ug+rwx bootstrap/cache
# chown -R deploy:www-data .

# Create symlinks to `storage` and `.env`
ln -sf $BASE_DIR/files/.env ./
rm -rf storage && ln -sf $BASE_DIR/files/storage ./

# Install laravel dependencies with composer
echo -e "${yellow}Installing composer dependencies ...${reset}"
/usr/bin/php$PHP_VERSION /usr/local/bin/composer install -o --no-interaction --no-dev

# Install Javascript dependencies using npm
echo -e "${blue}Installing npm dependencies ...${reset}"
npm install

# Generate JS and CSS resources using vite
npm run build

# Run database migrations
php artisan migrate --no-interaction --force

#create new project caches for config, views, routes and cache
php artisan view:clear
php artisan optimize

#Atomically switch application root directory (ZERO downtime)
echo -e "${blue}Doing atomic swap magic${reset}"
ln ln -sf "$RELEASE_DIR" $BASE_DIR/tobe-deployed #create temporary symlink
mv -T $BASE_DIR/tobe-deployed $BASE_DIR/deployed #atomically update app root directory
rm -f $BASE_DIR/tobe-deployed #delete temporary symlink
echo -e "${green}Atomic swap magic completed. The new site is live now!${reset}"

#Delete old releases leaving the latest 3
cd $BASE_DIR/releases
echo -e "${yellow}Deleting old releases${reset}"
ls . | head -n -3 | xargs -r rm -r

echo -e "${green}Dayalog Deployment completed!${reset}"

#END
