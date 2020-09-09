<?php
/**
 * Appクラス
 * ルーティングとコントローラーの接着剤
 */
class App
{
  protected $controllers = [];
  protected $request;
  protected $router;
  protected $response;

  public function __construct()
  {
    $this->request = new Request();
    $this->router = new Router();
    $this->response = new Response();
  }

  // ルーティングからアクションの実行、レスポンスを返すまで
  public function run(): void
  {
    $pathInfo = $this->request->getPathInfo();    
    $routed = $this->router->resolve($pathInfo);

    try {
      $controller = $this->findController($routed['controller']);
      
      $html = $controller->runAction($routed['action'], $routed['captured']);
      
      $this->response->send($html);
      
    } catch (HttpNotFoundException $e) {
      $this->response->render404page($e);
    }
  }
  
  public function findController(string $controller): object
  {
    if (!class_exists($controller)) {
      throw new HttpNotFoundException('コントローラーが存在しません');
    }    
    // まだコントローラーインスタンスが生成されていなければ、
    if (!isset($this->controllers[$controller])) {
      // 新規作成して配列に登録。
      $this->controllers[$controller] = new $controller();
    } 
    
    return $this->controllers[$controller];
  }
  
}