<?php
/**
 * Viewクラス
 * 
 */
class View
{ 
  protected $viewDir;
  
  public function __construct()
  {
    // このクラスファイルをビューファイルのルートディレクトリに置く
    $this->viewDir = dirname(__FILE__);
  }
  
  
  // protected $base_dir = dirname(__FILE__);
  
  public function render(string $viewName, array $variables = [], ?string $layoutName = null): string
  {
    $view = $this->viewDir . '/' . $viewName;
    $layout = $this->viewDir . '/' . $layoutName;

    
    if (!file_exists($view)) {
      throw new HttpNotFoundException('ビューが存在しません');
    }
    
    // ビューに埋め込む変数を連想配列から一括展開
    extract($variables);
    
    // つねに埋め込む値
    $baseUrl = Config::getBaseUrl();
    
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
  public function h(?string $string): ?string
  {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
  
}