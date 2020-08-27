<?php
/** 
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';
// $_ENV['PHP_ENV'] = 'heroku';
$app = new App();
$app->run();

// デバッグ用
echo '<pre>';
var_dump($_ENV['DATABASE_URL']);
var_dump(getenv('DATABASE_URL'));
echo '</pre>';