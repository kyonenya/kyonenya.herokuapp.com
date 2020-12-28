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
  public function insertEntries($data): void
  {
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
        ':starred' => $aData['starred'] ? 'true' : 'false',
        ':uuid' => $aData['uuid'],
        'creationDate' => $aData['creationDate'],
        'modifiedDate' => $aData['modifiedDate'],
      ]);
      
      if (isset($aData['tags'])) {
        $this->insertTags($aData['uuid'], $aData['tags']);
      }
    }
    
    $this->pdo->commit();
    
    echo 'success!';
  }

  /**
   * 記事タグを挿入する
   */
  public function insertTags(string $uuid, array $tags): void
  {
    $sql = '
      INSERT INTO manuscripts_tags
        (uuid, tag)
      VALUES
        (:uuid, :tag)
    ';

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);

    foreach ($tags as $tag) {
      $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
      $stmt->execute();
    }
  }
}
