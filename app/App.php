<?php
/**
 * Appクラス
 * アプリ全体のエントリーポイント
 * ルーターとコントローラーを仲介し、中で生じた例外をキャッチする。
 */
namespace App;
use \App\Exception;

class App
{
  protected $controllers = [];
  protected $request;
  protected $router;
  // TODO 消す
  protected $response;

  public function __construct()
  {
    $this->request = new Request();
    $this->router = new Router();
    $this->response = new Response();
  }

  /**
   * アプリのエントリーポイント
   * ルーティングからアクションの実行、レスポンスを返すまで
   */
  public function run(): void
  {
    $pathInfo = $this->request->getPathInfo();    
    $routed = $this->router->resolve($pathInfo);

    try {
      // コントローラーを呼び出す
      $controller = $this->findController($routed['controllerClass']);
      // アクションを実行する
      $html = $controller->runAction($routed['action'], $routed['captured']);
      // TODO 消す
      $this->response->send($html);
      
    } catch (Exception\HttpNotFound $e) {
      $this->response->render404page($e);
    } catch (Exception\Unauthorized $e) {
      $controller = $this->findController(\Config::ROUTE_ACTION[0]);
      $controller->runAction(\Config::ROUTE_ACTION[1]);
    } catch (Exception $e) {
      // ! とりあえず表示させる
      print_r($e);
    }
  }
  
  /**
   * コントローラークラスのインスタンスを見つけてくる
   * まだ生成されていない場合、新たに生成する。
   */
  public function findController(string $controller): object
  {
    if (!class_exists($controller)) {
      throw new Exception\HttpNotFound('コントローラーが存在しません');
    }    
    // まだコントローラーインスタンスが生成されていない場合、
    if (!isset($this->controllers[$controller])) {
      // 新規作成して配列に登録する。
      $this->controllers[$controller] = new $controller();
    } 
    
    return $this->controllers[$controller];
  }
  
}