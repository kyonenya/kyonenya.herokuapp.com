<?php
/* フロントコントローラー
 * ブラウザからの全てのアクセスをここに集める
 */
require '../bootstrap.php';

// Controller tester
/*
$controller = new AccountController();
echo $controller->runAction('signup', ['message' => 'こんにちは、世界']);
*/

$app = new App();
$app->run();

echo '<pre>';

/*
//db_manager tester
echo '<pre>';
$db_manager = new DbManager();
$db_manager->connect([
  'dsn' => 'sqlite:../database/mini_blog',
  'user' => '',
  'password' => '',
  'options' => [],
]);
*/

echo '</pre>';