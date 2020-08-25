<?php
/**
 * class Model
 * データベースの各テーブルごとの処理。
 * 
 */
abstract class Model
{
  protected $db;
  
  public function __construct()
  {
    // DBにまだ接続されていないならば、
    if (!isset($this->db)) {
      // 接続して接続情報を保持。
      $this->db = $this->connectDb(Config::getDbConfig());
    }
  }
  
  // SQL文を安全に実行
  public function execute(string $sql, array $params = []): object
  {
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    
    return $stmt;
  }
  
  // 1件抽出
  public function fetch(string $sql, array $params = []): array
  {
    return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }
  
  // 全件抽出
  public function fetchAll(string $sql, array $params = []): array
  {
    return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }
 
  // DB接続
  public function connectDb(array $config): object
  {    
    $db = new PDO($config['dsn'], $config['user'], $config['password'], $config['options']);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }

}