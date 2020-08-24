<?php
/**
 *
 *
 */
class App
{
  public $config;
  protected $request;
  protected $router;
  protected $response;

  public function __construct()
  {
    $this->config = new Config();
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router();
  }

  // ルーティングからアクションの実行、レスポンスを返すまで
  public function run(): void
  {
    $pathInfo = $this->request->getPathInfo();
    
    $routed = $this->router->resolve($pathInfo);
    
    if (!class_exists($routed['controller'])) {
      // TODO: 404を返す
      echo 'ルーティング先のコントローラークラスが存在しない';
    } else {
      // findController
      $controller = new $routed['controller']($this->config);
    }
    
    $html = $controller->runAction($routed['action'], $routed['params']);
    
    $this->response->send($html);
  }

}