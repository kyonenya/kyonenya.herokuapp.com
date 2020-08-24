<?php

class Request
{
  // URLの'https://example.com/'以降を取得
  /*
  public function getRequestUri() : ?string
  {
    return $_SERVER['REQUEST_URI'];
  }
  */
  
  // index.phpファイルへのパスを取得
  public function getBaseUrl(): ?string
  {
    $request_uri = $_SERVER['REQUEST_URI'];
    $index_path = $_SERVER['SCRIPT_NAME'];  // index.phpファイルまでのパス
    $index_dir = dirname($script_name);  // index.phpがあるフォルダまでのパス

    // 1. URLに'index.php'が省略されていないなら、
    if (strpos($request_uri, $index_path) === 0) {
      // そのままindex.phpまでのパスを返す。
      // return $index_path; // /myproject/web/index.php
      // パスインフォが使えないDraftCode環境に合わせる。
      return $index_path . '?l=';
    }
    // 2. URLにindex.phpが省略されているなら、例）foo/bar/(index.php)/list
    elseif (strpos($request_uri, $index_dir) === 0) {
      // index.phpがあるフォルダまでのパスを返す。
      return rtrim($index_dir, '/');  // foo/bar
    }
    
    // 3. その他：ルート直下にindex.phpがある場合
    return '';
  }
  
  // URLの'index.php'以降を取得
  public function getPathInfo(): ?string
  {
    // return $_SERVER['PATH_INFO'];
    

    // DraftCodeではApacheなどの機能であるパスインフォが使えないので、index.php?l=(ここにパスインフォの代わりを書く)
    return $this->getGet('l', '/');
  } 

  
  // GETパラメータを取得、第二引数にnullだったとき用の値
  public function getGet(string $name, string $default = null)
  {
    return filter_input(INPUT_GET, $name) ?? $default;
  }

}