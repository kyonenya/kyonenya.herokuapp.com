<?php
/**
 * class Controller
 * 
 */
abstract class Controller
{
  public $models = [];
  protected $view;

  public function __construct($config)
  {
    $this->view = new View();
  }
  
  public function runAction(string $action, array $params = []): ?string
  {
    if (!method_exists($this, $action)) {
      echo 'アクションが存在しません';
      throw new Exception();
    }
    
    $html = $this->$action($params);
    
    return $html;
  }

  public function findModel(string $model): object
  {
    if (!class_exists($model)) {
      echo 'クラスが存在しません';
    }
    // まだモデルインスタンスが生成されていなければ新規作成して登録
    if (!isset($this->models[$model])) {
      $this->models[$model] = new $model();
    }
    
    return $this->models[$model];
  }
  
}