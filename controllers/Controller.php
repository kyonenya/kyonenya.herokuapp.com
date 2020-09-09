<?php
/**
 * Controllerクラス
 * 
 */
abstract class Controller
{
  protected $models = [];
  protected $request;
  protected $view;
  protected $response;
  protected $session;

  public function __construct()
  {
    $this->request = new Request();
    $this->view = new View();
    $this->response = new Response();
    $this->session = new Session();
  }
  
  public function runAction(string $action, array $params = []): ?string
  {
    if (!method_exists($this, $action)) {
      throw new HttpNotFoundException('アクションが存在しません');
    }
    
    $html = $this->$action($params);
    
    return $html;
  }

  public function findModel(string $model): object
  {
    if (!class_exists($model)) {
      throw new HttpNotFoundException('モデルが存在しません');
    }
    // まだモデルインスタンスが生成されていなければ、
    if (!isset($this->models[$model])) {
      // 新規作成して配列に登録。
      $this->models[$model] = new $model();
    }
    
    return $this->models[$model];
  }
  
}