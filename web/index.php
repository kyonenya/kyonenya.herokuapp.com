<?php
/** 
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';

// デバッグ用
echo '<pre>';
var_dump($_ENV['DATABASE_URL']);
var_dump(getenv('DATABASE_URL'));
echo '</pre>';

$app = new App();
$app->run();