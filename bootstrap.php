<?php
/**
 * bootstrap.php
 * 自動実行処理
 * クラスのオートロード設定ほか、必要な前処理をここに書く。
 */

// 強い型付けを宣言
declare(strict_types = 1);

/** 
 * クラスのオートロード
 */
require 'app/ClassLoader.php';
$classLoader = new ClassLoader();
// 読み込み先のディレクトリを登録
$classLoader->registerDir(dirname(__FILE__) . '/app');
$classLoader->registerDir(dirname(__FILE__) . '/models');
$classLoader->registerDir(dirname(__FILE__) . '/controllers');
// オートロード処理を実行
$classLoader->register();

// 手動ロード
require 'views/View.php';
require 'app/functions.php';

$_ENV['DATABASE_URL']= 'postgres://zxehjkojxygwch:3b483c8c5a70f746ffdf7f08d600d41b6a5c59d1fb911ac7b2046a8592b9b63e@ec2-23-20-168-40.compute-1.amazonaws.com:5432/de9v5vgk53jcli';
