#!/bin/sh 
#!/bin/bash

apk add php7-fpm php7-mcrypt php7-soap php7-openssl php7-gmp php7-pdo_odbc php7-json php7-dom php7-pdo php7-zip php7-mysqli php7-bcmath php7-gd php7-odbc php7-pdo_mysql php7-gettext php7-xmlreader php7-xmlrpc php7-bz2 php7-iconv php7-curl php7-ctype php7-redis
sed -i -e 's/short_open_tag = Off/short_open_tag = On/' /etc/php7/php.ini
sed -i -e 's/nginx -s reload 2>/dev/null || nginx -c /etc/nginx/nginx.conf/nginx -s reload 2>/dev/null || nginx -c /etc/nginx/nginx.conf && php-fpm7/' docker/docker-entrypoint.sh
echo "php安装完成，开始克隆仓库"

git clone https://github.com/Leefc-git/nvjdc-ccwav.git

read -t 30 -p "克隆完成，请输入您的wxpuher应用Id:" appid

sed -i -e "s/your_appid/${appid}/" nvjdc-ccwav/callback.php

mkdir callback
mv nvjdc-ccwav/callback.php callback/
mv nvjdc-ccwav/index.php callback/
mv nvjdc-ccwav/callback.conf /etc/nginx/conf.d/
mv nvjdc-ccwav/CK_WxPusherUid.json scripts/ccwav_QLScript2/
chmod 777 scripts/ccwav_QLScript2/CK_WxPusherUid.json

echo "部署完成，请重启青龙容器docker restart qinglong"
