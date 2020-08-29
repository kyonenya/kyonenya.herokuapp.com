<?php
/**
 *
 *
 */
class App
{
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
      if (!class_exists($routed['controller'])) {
        throw new Exception();
      } else {
        // TODO: いちいちnewせずfindControllerで見つけてくる
        $controller = new $routed['controller']($this->config);
      }
      
      $html = $controller->runAction($routed['action'], $routed['params']);
      
      $this->response->send($html);
      
    } catch (Exception $e) {
      echo '例外：404エラー';
    }
  }
  
}