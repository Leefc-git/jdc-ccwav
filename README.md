2022/01/28
更新pin匹配规则
同步wxuid文件路径


#一个用来自动绑定wxpusher uid和京东pt_pin的php文件

#不一定要使用nvjdc,本质上就是在登录成功后扫码就会自动绑定，用什么面板都一样。

青龙2.10.8(最好是这个版本，基于这个版本弄的)

nvjdc1.4(或者kingfeng这种可以在登录后调关注二维码的)(这个版本随便，部署的时候配置文件qrurl里填wxpusher的应用二维码，网页窗口限制1) 

#只要再登录成功后放二维码就好，不管是ninja还是其他的ck登录面板

ccwav推送库

wxpusher

部署青龙时多映射一个端口

docker run -dit \
   -v $PWD/ql/config:/ql/config \
   -v $PWD/ql/log:/ql/log \
   -v $PWD/ql/db:/ql/db \
   -p 5700:5700 \
   -p 5702:5702 \
   --name qinglong \
   --hostname qinglong \
   --restart always \
   whyour/qinglong:latest

wxpusher创建应用填入回调地址并记好你的应用id

http://你的ip:5702/callback.php

全部部署好并拉取ccwav库(记得青龙里配置token)以后进入青龙容器

docker exec -it qinglong bash

直接跑脚本。填入你的应用id

wget https://raw.githubusercontent.com/Leefc-git/nvjdc-ccwav/main/auto.sh && chmod 777 auto.sh && ./auto.sh

退出容器，重启青龙。

docket restart qinglong

为防止绑定串号，nvjdc最好是只开一个网页窗口，且只能在首次登录成功后扫码关注才行。

第一次扫码登录以后尽快关注微信公众号才可以绑定，
   后续关注需要私聊管理员，手动绑定，多账号推送先取消关注，
   登录其他账户以后再关注。重复操作即可。
