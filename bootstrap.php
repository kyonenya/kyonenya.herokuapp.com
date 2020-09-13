<?php
/**
 * bootstrap.php
 * クラスのオートロード設定など、アプリの実行に必要な前処理をここに書く。
 * index.phpから読み込まれて自動実行される。
 */

// 強い型付けを宣言
declare(strict_types = 1);

// 以下のクラスは手動でロードしておく
// 設定ファイルをロード
require 'Config.php';
require 'app/functions.php';

/**
 * クラスを自動でロードする
 * クラスファイル命名規則：./名前空間名（先頭小文字）/クラス名.php
 */
spl_autoload_register(function(string $fullyQualifiedName) {
  // 完全修飾名の先頭のバックスラッシュを除去する
  $qualifiedName = ltrim($fullyQualifiedName, '\\');
  // 修飾名をファイルパスに変換する
  $classFile = __DIR__ . '/' . lcfirst(str_replace('\\', '/', $qualifiedName)) . '.php';
  // クラスファイルをロードする
  if (file_exists($classFile)) {
    require $classFile;
  }
});

//  エラーを表示するかどうか
// ini_set('display_errors', '0');