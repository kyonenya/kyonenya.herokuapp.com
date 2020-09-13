<?php
/**
 * Model抽象クラス
 * データベースの各テーブルごとの処理、
 * またはそれに限定されないデータ加工処理を担う。
 */
namespace Model;
use \PDO;
use \PDOException;

abstract class Model
{
  protected $pdo;
  
  public function __construct()
  {
    // DBにまだ接続されていない場合、
    if (!isset($this->pdo)) {
      // 接続して接続情報を保持する。
      $this->pdo = $this->connectDb(\Config::getDbConfig());
    }
  }
  
  /**
   * SQL文を安全に実行する
   */
  public function execute(string $sql, array $params = []): object
  {
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($params);
      return $stmt;
    } catch (PDOException $e) {
      // トランザクション処理を取り消す
      $this->pdo->rollBack();
      echo $e->getMessage();
      die();
    }
  }
  
  /**
   * データを一件抽出する
   */
  public function fetch(string $sql, array $params = []): array
  {
    return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }
  
  /**
   * データを全件抽出する
   */
  public function fetchAll(string $sql, array $params = []): array
  {
    return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * 最後に挿入されたデータのIDを取得する
   */
  public function getLastInsertedId()
  {
    return $this->pdo->lastInsertId();
  }
  
  /**
   * データベースに接続して接続情報を返す
   */
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