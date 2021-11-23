#一个用来自动绑定wxpusher和京东pt_pin的php文件
一对一推送

#食用方法
1.青龙容器 (内装php)
2.Nvjdc
3.ccwav一对一推送库

一、青龙容器安装php，配置好nginx和php解析，设置自启动
   映射额外端口接收wxpusher用户扫码关注后的回调，
    wxpusher的应用设置要设置好回调地址
    http://你的ip:端口/callback.php

二、把callback.php上传到容器里，修改里面的内容，
    appid  ==   你的wxpusher应用id
    青龙和对应文件路径也要改。

三、第一次扫码登录以后尽快关注微信公众号才可以绑定，
   后续关注需要私聊管理员，手动绑定，多账号推送先取消关注，
   登录其他账户以后再关注。重复操作即可。
