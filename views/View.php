<?php
/**
 *
 *
 */
class View
{
  protected $request;
  
  public function __construct()
  {
    $this->request = new Request();
  }
  
  // ビューファイルのルートディレクトリに当クラスファイルを置く
  // protected $base_dir = dirname(__FILE__);
  
  public function render(string $view, array $variables = [], ?string $layout = null): string
  {
    $viewFile = dirname(__FILE__) . '/' . $view;
    $layoutFile = dirname(__FILE__) . '/' . $layout;
    
    // ビューに埋め込む変数を連想配列から一括展開
    $variables['baseUrl'] = $this->request->getBaseUrl();
    extract($variables);
    
    // requireした瞬間にechoされないよう、requireしたら文字列を受け取る
    ob_start();
    ob_implicit_flush(0);  // バッファ上限を無効化
    require $viewFile;
    $html = ob_get_clean();

    // もしレイアウトビューが存在するなら、
    if ($layout) {
      // さっきのビュー（$content）をさらにレイアウトに埋め込んだ結果を再代入。
      require $layoutFile;
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