<?php
/**
 * Requestクラス
 * ブラウザからのリクエスト情報やURL文字列の処理
 */
namespace App;

class Request
{  
  /**
   * パス情報を取得する
   * URLの中で最も重要な、ルーティングに用いる最末尾の部分
   * 例）'posts/123'
   */
  public function getPathInfo(): ?string
  {
    if (isset($_SERVER['PATH_INFO'])) {
      return $_SERVER['PATH_INFO'];
    }
    
    $requestUri = $this->getRequestUri();
    $baseUrl = \Config::getBaseUrl();
        
    if (\Config::isRewriteEngineOn()) {
      // リクエストURIからベースURLを引き算する
      return substr($requestUri, strlen($baseUrl)); 
    } else {
      // クエリ文字列でパス情報を代用する
      return $this->getGet('l', '/');      
    }   
  }
  
  /**
   * リクエストURIを取得する
   * URLのドメイン以降の部分、ただしGETパラメーターを除く
   * リクエストURI＝ベースURL＋パス情報
   * 例）'/index.php/posts/123'
   */
  public function getRequestUri(): string
  {
    $pos = strpos($_SERVER['REQUEST_URI'], '?');

    if ($pos === false) {
      return $_SERVER['REQUEST_URI'];
    } else {
      // GETパラメータを削除、先頭から'?'の前までを返す
      return substr($_SERVER['REQUEST_URI'], 0, $pos);
    }   
  }

  /**
   * GETパラメータを取得する
   */
  public function getGet(string $name, string $default = null): string
  {
    return (filter_input(INPUT_GET, $name))
      ?? $default;  // GETパラメータがnullの場合
  }
  
  /**
   * POSTでアクセスされたかどうか
   */
  public function isPost(): bool
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * POST内容を取得する
   */
  public function getPost(string $name, ?string $default = null): string
  {
    return (filter_input(INPUT_POST, $name))
      ?? $default;  // POST内容がnullの場合
  }
  
}