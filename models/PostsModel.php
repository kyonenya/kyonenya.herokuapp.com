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
        'tags' => $post['tags'],
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
    $sql = (Config::getDbType() === 'postgres')
      ? $sql_postgres
      : $sql_sqlite;

    $posts = $this->fetchAll($sql);
    
    // カンマ区切りで取得したタグを配列に展開しておく
    foreach ($posts as &$post) {
        $post['tags'] = explode(',', $post['tags']);
    }
    
    return $posts;
  }

  public function fetchPost(int $id): array
  {
    $sql = 'SELECT posts.*, GROUP_CONCAT(tags.tag) AS tags
      FROM posts 
      INNER JOIN tags
        ON posts.id = tags.post_id
          AND posts.id = :id';
    
    $post = $this->fetch($sql, [
      ':id' => $id,
    ]);
    
    $post['tags'] = explode(',', $post['tags']);
    
    return $post;
  }
  
}