<?php
$sDBHost = '127.0.0.1';
$sDBUserName = 'root';
$sDBPassword = '';
$sDBName = 'msg';

$oDBLink = @mysqli_connect($sDBHost, $sDBUserName, $sDBPassword, $sDBName);
if (!$oDBLink) {
    die('資料庫連結失敗!');
}
mysqli_query($oDBLink, "SET NAMES 'utf8'");
?>