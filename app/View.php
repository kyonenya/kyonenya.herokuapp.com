<?php
/**
 * Viewクラス
 * ビューのHTML文字列を組み立てて返す
 */
namespace App;
use \App\Exception;

class View
{ 
  protected $viewDir;
  
  public function __construct()
  {
    $this->viewDir = __DIR__ . '/../view';
  }
  
  /**
   * ビューを描画する
   * HTML文字列を組み立てて返す
   */
  public function render(string $viewName, array $variables = [], ?string $layoutName = null): string
  {
    $view = $this->viewDir . '/' . $viewName;
    $layout = $this->viewDir . '/' . $layoutName;
    
    if (!file_exists($view)) {
      throw new Exception\HttpNotFound('ビューが存在しません');
    }
    
    // ビューに埋め込む変数を連想配列から一括展開
    extract($variables);
    
    // つねに埋め込む値
    $baseUrl = \Config::getBaseUrl();
    
    // requireした瞬間にechoされないよう、requireしたら文字列を受け取る
    ob_start();
    ob_implicit_flush(0);  // バッファ上限を無効化
    require $view;
    $html = ob_get_clean();

    // もしレイアウトビューが存在するなら、
    if (file_exists($layout)) {
      // さっきのビュー（$content）をさらにレイアウトに埋め込んで、その結果を再代入する。
      require $layout;
      $html = ob_get_clean();
    }
    
    return $html;
  }
  
  // いつもの
  // TODO 可変長引数で一括処理したい
  public function h(?string $string): ?string
  {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
  
}