<?php
session_start(); //开启session
$_rnd_code = 4; //随机验证码的个数
for ($i=0;$i<$_rnd_code;$i++) { //创建随机码
    $_nmsg .= dechex(mt_rand(0,15)); //把十进制转换成16进制
}
$_SESSION['code'] = $_nmsg; //随机码保存在session
$_width = 75; //长和高
$_height = 25;
$_img = imagecreatetruecolor($_width,$_height); //创建一张图像(背景默认为黑色)
$_white = imagecolorallocate($_img,255,255,255);//创建白色画笔
imagefill($_img,0,0,$_white);//填充背景颜色
$_black = imagecolorallocate($_img,0,0,0);
imagerectangle($_img,0,0,$_width-1,$_height-1,$_black); //绘制黑色边框
//随机画出6个线条
for ($i=0;$i<6;$i++) {
    $_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
}
//随机画出100个雪花
for ($i=0;$i<100;$i++) {
    $_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
    imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
}
//输出验证码
for ($i=0;$i<strlen($_session['code']);$i++) p="">
    $_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
    imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);//分别把各个字符放到各自的范围内并防治字符溢出
}
//输出图像
header('Content-Type: image/png');
imagepng($_img);
//销毁资源
imagedestroy($_img);
?>