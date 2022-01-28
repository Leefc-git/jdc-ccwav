<!DOCTYPE HTML>
<html>
<body>
<?php
 //文件放在青龙容器callback文件夹内，新建
//接受wxpusher回调
$json = file_get_contents("php://input");
$data = json_decode($json, true);

foreach($data as $value) {
  if ($value[appId] == your_appid){ //your_appid修改这里为你的应用id
    //调取登录的jdck
    $file = file("/ql/db/env.db");//数据库路径
    $created_num = 0;
    $pt_pin = "null";
    for($i=0;$i<count($file);$i++){
      $created_head = substr($file[$i],strpos($file[$i],'created')+9);
      $created_end = substr($created_head,0,strpos($created_head,','));
      $created = (int)$created_end;
      if ($created < $created_num) {
      } else {
        $created_num = $created;
        $pt_pin_head = substr($file[$i],strpos($file[$i],'pt_pin=')+7);
        $pt_pin = substr($pt_pin_head,0,strpos($pt_pin_head,';'));

      }
    }
    //CK_WxPusherUid.json文件
    $origin = json_decode(file_get_contents('/ql/scripts/CK_WxPusherUid.json'), true);//wxck路径
    
    function deep_in_array($value, $array) {
      foreach($array as $item) {
        if(!is_array($item)) {
            if ($item == $value) {
                return true;
            } else {
                continue;
            }
        }
        if(in_array($value, $item)) {
            return true;
        } else if(deep_in_array($value, $item)) {
            return true;
        }
      }
      return false;
    }

    if (deep_in_array($pt_pin, $origin) == 1) {
      echo "exist";
    } else {
      $origin[] = array(                            
        'pt_pin' => $pt_pin,                          
        'Uid' => $value['uid'],
      );
      $wx_json = json_encode($origin);             
      file_put_contents('/ql/scripts/CK_WxPusherUid.json', $wx_json);
    }
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
