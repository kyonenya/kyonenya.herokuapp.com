<?php
/** 
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';

// デバッグ用
echo '<pre>';
echo '</pre>';

$app = new App();
$app->run();