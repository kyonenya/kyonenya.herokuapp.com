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
    // まだモデルインスタンスが生成されていなければ新規作成して登録
    if (!isset($this->models[$model])) {
      $this->models[$model] = new $model();
    }
    
    return $this->models[$model];
  }
  
}