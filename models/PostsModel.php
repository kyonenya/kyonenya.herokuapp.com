<?php
/**
 * PostsModel.php
 * postsテーブル（ならびにtagsテーブル）を操作
 */
class PostsModel extends Model 
{
  public function getPostlist() {
    $posts = $this->fetchAllPosts();
    
    $postlist = array_map(function ($post) {
      $created_datetime = new DateTime($post['created_at']);
      $created_at = $created_datetime->format('Y-m-d');
      return [
        'id' => $post['id'],
        'title' => $post['title'],
        'body' => mb_substr(strip_tags($post['body']), 0, 110),
        'created_at' => $created_at,
        'tags' => explode(',', $post['tags']),
      ];
    }, $posts);
    
    return $postlist;
  }

  public function fetchAllPosts(): array
  {
    // 複数の記事タグの結合にGROUP_CONCATを使う
    $sql_sqlite = '
      SELECT posts.*, GROUP_CONCAT(tags.tag) AS tags
        FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
          GROUP BY posts.id
        ORDER BY id DESC';

    // PostgreSQLではSTRING_AGGを使う
    $sql_postgres = "
      SELECT posts.*, STRING_AGG(tags.tag, ',') AS tags
        FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
          GROUP BY posts.id
        ORDER BY id DESC";
    
    // DBごとにスイッチ
    $dbType = Config::getDbType();
    $sql = $dbType === 'postgres' 
      ? $sql_postgres
      : $sql_sqlite;

    return $this->fetchAll($sql);
  }

  public function fetchPost(int $id): array
  {
    $sql = 'SELECT * FROM posts WHERE id = :id';
    
    $post = $this->fetch($sql, [
      ':id' => $id,
    ]);
    
    return $post;
  }
  
}