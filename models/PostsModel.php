<?php
/**
 * 
 */
class PostsModel extends Model 
{
  // $db;
  
  public function fetchAllPostlists(): array
  {
    // 複数タグの結合にGROUP_CONCATを使う
    $sql_sqlite = '
      SELECT posts.*, GROUP_CONCAT(tags.tag) AS tags
        FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
          GROUP BY posts.id
        ORDER BY id DESC';

    // PostgreSQLでは複数タグの結合にSTRING_AGGを使う
    $sql_postgres = "
      SELECT posts.*, STRING_AGG(tags.tag, ',') AS tags
        FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
          GROUP BY posts.id
        ORDER BY id DESC";
    
    switch (Config::getDbType()) {
      case 'postgres': 
        $sql = $sql_postgres;
        break;
      case 'sqlite': 
        $sql = $sql_sqlite;
        break;
    }
    
    $posts = $this->fetchAll($sql);
    
    $postlists = [];
    
    foreach ($posts as $post) {
      $postlists[] = [
        'id' => $post['id'],
        'title' => $post['title'],
        'body' => mb_substr(strip_tags($post['body']), 0, 110),
        'created_at' => $post['created_at'],
        'tags' => explode(',', $post['tags']),
      ];
    }
    
    return $postlists;
  }
  
  public function fetchArticle(int $id): array
  {
    $sql = "SELECT * FROM posts WHERE id = :id";
    
    $article = $this->fetch($sql, [
      ':id' => $id,
    ]);
    
    return $article;
  }
   
  // select * from posts join tags on posts.id = tags.post_id;
}