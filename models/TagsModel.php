<?php
/**
 * 
 */
class TagsModel extends Model
{
  public function fetchTags(int $id): array
  {
    $sql = 'SELECT tag FROM tags WHERE post_id = :id';
    
    $fetched = $this->fetchAll($sql, [
      ':id' => $id,
    ]);
    
    $tags = array_map(function ($each) {
      return $each['tag'];
    }, $fetched);
    
    return $tags;
  }

}