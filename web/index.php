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

echo '</pre>';