<?php
/**
 * Manuscriptsモデル
 */
namespace Model;

use \PDO;

class Manuscripts extends Model
{
  /**
   * 記事を挿入する
   */
  public function insertPost($data): void
  {
    $data = array_slice($data, 20);
    var_dump($data);
    
    $sql = '
      INSERT INTO manuscripts (
        text
        ,starred
        ,uuid
        ,creationDate
        ,modifiedDate
      )
      VALUES
        (:text, :starred, :uuid, :creationDate, :modifiedDate)
      ';

    $this->pdo->beginTransaction();
    
    foreach ($data as $aData) {
      $this->execute($sql, [
        ':text' => $aData['text'],
        ':starred' => $aData['starred'],
        ':uuid' => $aData['uuid'],
        'creationDate' => $aData['creationDate'],
        'modifiedDate' => $aData['modifiedDate'],
      ]);
    }
    
    $this->pdo->commit();
    
    echo 'success!';
  } 
}
