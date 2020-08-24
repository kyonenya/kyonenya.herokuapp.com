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