<?php
namespace App;
/**
 * Routerクラス
 * リクエストURLからコントローラーを紐付ける
 */

class Router 
{
  protected $routes;

  /**
   * ルーティングを実行する
   * パス情報に対応するコントローラーとアクションを返す
   */
  public function resolve(?string $pathInfo = '/'): array
  {
    $routes = \Config::ROUTE_DEFINITIONS;
    
    foreach ($routes as $path => $routed) {
      $pattern = '#^' . $path . '$#';
      if (preg_match($pattern, $pathInfo, $matches) === 1) {
        // コントローラー名に名前空間を適用
        $routed['controllerClass'] = '\\Controller\\' . $routed['controller'];
        
        return array_merge($routed, ['captured' => $matches]);
      }
    }
  } 
}
