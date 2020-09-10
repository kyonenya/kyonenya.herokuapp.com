<?php
/**
 * Controllerクラス
 * あらゆる処理の担い手
 */
namespace Controller;
use \App\Exception;

abstract class Controller
{
  protected $models = [];
  protected $request;
  protected $view;
  protected $response;
  protected $session;

  public function __construct()
  {
    $this->request = new \App\Request();
    $this->view = new \View\View();
    $this->response = new \App\Response();
    $this->session = new \App\Session();
  }
  
  public function runAction(string $action, array $params = []): ?string
  {
    if (!method_exists($this, $action)) {
      throw new Exception\HttpNotFound('アクションが存在しません');
    }
    
    $html = $this->$action($params);
    
    return $html;
  }

  public function findModel(string $modelName): object
  {
    // モデル名に名前空間を適用
    $modelClass = '\\Model\\' . $modelName;
    
    if (!class_exists($modelClass)) {
      throw new Exception\HttpNotFound('モデルが存在しません');
    }
    // まだモデルインスタンスが生成されていなければ、
    if (!isset($this->models[$modelName])) {
      // 新規作成して配列に登録。
      $this->models[$modelName] = new $modelClass();
    }
    
    return $this->models[$modelName];
  }
  
}