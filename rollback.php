<!DOCTYPE HTML>
<html>
<body>
<?php
//接收回调
$json = file_get_contents("php://input");
$data = json_decode($json, true);
//分割uid
foreach($data as $value) {
  if ($value[appId] == 14207){
    //取出pt_pin
    $file = file("/ql/db/env.db");
    $jd_ck = $file[count($file)-1];
    $a = substr($jd_ck,strpos($jd_ck,';pt_pin=')+8);
    $cost = substr($a,0,strpos($a,';'));
    //写入配置文件
    $origin = json_decode(file_get_contents('/ql/scripts/ccwav_QLScript2/CK_WxPusherUid.json'), true);
      $origin[] = array(
        'pt_pin' => $cost,
        'Uid' => $value['uid'],
    );
  $wx_json = json_encode($origin);
  file_put_contents('/ql/scripts/ccwav_QLScript2/CK_WxPusherUid.json', $wx_json);

  }
}

echo '
{
    "msg": "OK"
}
';
?>
</body>
</html>
