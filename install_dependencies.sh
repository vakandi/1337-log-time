apt install composer
composer require league/oauth2-client
wget -qO - https://packages.sury.org/php/apt.gpg | sudo apt-key add -
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/sury-php.list
apt update
apt-get install php8.1-common php8.1-curl php8.1-bcmath php8.1-intl php8.1-mbstring php8.1-xmlrpc php8.1-mcrypt php8.1-mysql php8.1-gd php8.1-xml php8.1-cli php8.1-zip-
apt install php8.1 libapache2-mod-php8.1 php8.1-fpm
a2enmod proxy_fcgi setenvif && sudo a2enconf php8.1-fpm
systemctl restart apache2
