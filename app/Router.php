<?php
/**
 * Router
 *
 */
class Router 
{
  protected $routes;
  
  public function __construct()
  {
    $this->routes = Config::ROUTE_DEFINITIONS;
  }

  // ルーティング実行部、パスインフォに対応するコントローラーとアクションを返す。
  public function resolve(?string $pathInfo = '/'): array
  {
    foreach ($this->routes as $path => $routed) {
      $pattern = '#^' . $path . '$#';
      if (preg_match($pattern, $pathInfo, $matches)) {
        // 名前付きマッチング以外の値を削除
        $params = array_filter($matches, function($value, $key) {
          return !is_int($key);
        }, ARRAY_FILTER_USE_BOTH);
        
        return array_merge($routed, ['params' => $params]);
      }
    }
  }
  
}