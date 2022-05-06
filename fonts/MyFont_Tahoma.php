<?
/* http://div.expertduck.com/?p=436 */
// font JasmineUPC
$font = 'tahoma'; //ชื่อไฟล์ฟ้อนต์ไม่ต้องใส่นามสกุล 
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
header('Access-Control-Allow-Origin:*');
if(strpos($ua,'msie')){
header('Content-type: font/eot');
$file = $font.'.eot';
}else{
header('Content-type: font/ttf');
$file = $font.'.ttf';
}
header('Content-length: '.filesize($file));
readfile($file);
exit;
?>