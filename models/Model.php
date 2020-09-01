<?php
/**
 * class Model
 * データベースの各テーブルごとの処理。
 * 
 */
abstract class Model
{
  protected $pdo;
  
  public function __construct()
  {
    // DBにまだ接続されていないならば、
    if (!isset($this->pdo)) {
      // 接続して接続情報を保持。
      $this->pdo = $this->connectDb(Config::getDbConfig());
    }
  }
  
  // SQL文を安全に実行
  public function execute(string $sql, array $params = []): object
  {
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($params);
      return $stmt;
    } catch (PDOException $e) {
      echo $e;
    }    
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

  // 
  public function getLastInsertedId()
  {
    return $this->pdo->lastInsertId();
  }
  
  // DB接続
  public function connectDb(array $config): object
  {    
    try {
      $pdo = new PDO($config['dsn'], $config['user'], $config['pass']);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
      echo 'データベース接続エラー：' . $e->getMessage();
      exit;
    }
    return $pdo;
  }

}