<?php
namespace App;
/**
 * Routerクラス
 * リクエストURLからコントローラーを紐付ける
 */

class Router 
{
  /**
   * ルーティングを実行する
   * パス情報に対応するコントローラーとアクションを返す
   */
  public function resolve(?string $pathInfo = '/', array $definitions): array
  { 
    foreach ($definitions as $path => $routed) {
      $pattern = '#^' . $path . '$#';
      if (preg_match($pattern, $pathInfo, $matches) === 1) {
        // コントローラー名に名前空間を適用
        $routed['controllerClass'] = '\\Controller\\' . $routed['controller'];
        
        return array_merge($routed, ['captured' => $matches]);
      }
    }
  } 
}
