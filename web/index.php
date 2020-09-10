<?php
/** 
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';

$app = new \App\App();
$app->run();

// デバッグ用
echo '<pre>';
echo '</pre>';