#!/bin/sh 
#!/bin/bash

apk add php7-fpm php7-mcrypt php7-soap php7-openssl php7-gmp php7-pdo_odbc php7-json php7-dom php7-pdo php7-zip php7-mysqli php7-bcmath php7-gd php7-odbc php7-pdo_mysql php7-gettext php7-xmlreader php7-xmlrpc php7-bz2 php7-iconv php7-curl php7-ctype php7-redis
sed -i -e 's/short_open_tag = Off/short_open_tag = On/' /etc/php7/php.ini
sed -i '/reload/a\php-fpm7' docker/docker-entrypoint.sh
echo "php安装完成，开始克隆仓库"

git clone https://github.com/Leefc-git/nvjdc-ccwav.git

read -t 30 -p "克隆完成，请输入您的wxpusher应用Id:" appid

sed -i -e "s/your_appid/${appid}/" nvjdc-ccwav/callback.php

mkdir callback
cp nvjdc-ccwav/callback.php callback/
cp nvjdc-ccwav/index.php callback/
cp nvjdc-ccwav/callback.conf /etc/nginx/conf.d/
cp nvjdc-ccwav/CK_WxPusherUid.json scripts/
chmod 777 scripts/CK_WxPusherUid.json

echo "部署完成，请退出容器重启青龙和Nolan容器(docker restart qinglong)"
exit
