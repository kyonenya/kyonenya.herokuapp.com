<?php
/**
 * index.php
 * フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める。
 */
require '../bootstrap.php';
$_ENV['ADMIN_PASSWORD'] = '$2y$10$LyM5dMo3qxKupPAZtReeCug0acU//EG0FUaXkGmG43vooyB4aszfi';

$app = new \App\App();
$app->run();

// デバッグ用
// echo '<pre>';
//echo '</pre>';
