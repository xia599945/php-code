<?php
header('Content-Type:text/html; charset=utf-8');

$type=isset($_GET['type']) ? $_GET['type'] : exit();

function dayin($data){
    foreach($data as $k=>$v){
        echo "{$k}：\n\t\t{$v}\n\n";
    }
}

echo '<pre>';

switch ($type){
    case 'agent':
        echo $_SERVER['HTTP_USER_AGENT'];
        break;
    case 'get':
        dayin($_GET);
        break;
    case 'post':
        dayin($_POST);
        break;
    case 'cookie':
        dayin($_COOKIE);
        break;
    case 'server':
        dayin($_SERVER);
        break;
    case 'all':
        echo '$_GET:'."<br>\n";
        var_dump($_GET);
        echo "<br>\n".'$_POST:'."<br>\n";
        var_dump($_POST);
        echo "<br>\n".'$_COOKIE:'."<br>\n";
        var_dump($_COOKIE);
        echo "<br>\n".'$_SERVER:'."<br>\n";
        var_dump($_SERVER);
        break;
    default:
        echo 'empty';
}

echo '</pre>';

?>
