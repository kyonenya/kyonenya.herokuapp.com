<?php
/**
 * ClassLoaderクラス
 * クラスのオートロード
 * 
 * bootstrap.php（自動実行処理）から呼び出す。
 */
// 命名規則：クラス名.php
namespace App;

class ClassLoader
{ 
  protected $dirs = [];
  
  // 読み込み先のディレクトリをいくつでも登録できる
  public function registerDir(string $dir): void
  {
    // dirs配列の要素として、新たに登録したいディレクトリを順次追加
    $this->dirs[] = $dir;
  }
    
  // オードロードを実行
  public function register(): void
  {
    spl_autoload_register(function (string $className) {
      // ディレクトリ内のクラスファイルを一件づつ照合していき、
      foreach ($this->dirs as $eachDir) {
        $classFile = $eachDir . '/' . $className . '.php';
        // マッチしたら、
        if (is_readable($classFile)) {
          // そのクラスファイルをrequireして、
          require $classFile;
          // その時点で処理を終了。
          return;
        }
      }
    });
  }

}