<?php
/** 
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';

// デバッグ用
echo '<pre>';
// $_ENV['DATABASE_URL']= 'postgres://zxehjkojxygwch:3b483c8c5a70f746ffdf7f08d600d41b6a5c59d1fb911ac7b2046a8592b9b63e@ec2-23-20-168-40.compute-1.amazonaws.com:5432/de9v5vgk53jcli';
// var_dump(Config::getDbConfig());
echo '</pre>';

$app = new App();
$app->run();