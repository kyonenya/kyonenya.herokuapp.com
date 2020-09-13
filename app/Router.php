<?php
/**
 * Routerクラス
 * リクエストURLからコントローラーを紐付ける
 */
namespace App;

class Router 
{
  protected $routes;
  
  public function __construct()
  {
    $this->routes = \Config::ROUTE_DEFINITIONS;
  }

  /**
   * ルーティングを実行する
   * パス情報に対応するコントローラーとアクションを返す
   */
  public function resolve(?string $pathInfo = '/'): array
  {
    foreach ($this->routes as $path => $routed) {
      $pattern = '#^' . $path . '$#';
      if (preg_match($pattern, $pathInfo, $matches) === 1) {
        // コントローラー名に名前空間を適用
        $routed['controllerClass'] = '\\Controller\\' . $routed['controller'];
        
        return array_merge($routed, ['captured' => $matches]);
      }
    }
  }
  
}