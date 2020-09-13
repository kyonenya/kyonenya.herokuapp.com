<?php
/**
 * Postsモデル
 * データベースのpostsテーブル・tagsテーブルのCRUD処理
 */
namespace Model;
use \PDO;

class Posts extends Model
{
  /**
   * 記事一覧データを取得して整形する
   */
  public function getPostlist() {
    $posts = $this->fetchAllPosts();

    return array_map(function ($post) {
      return [
        'id' => $post['id'],
        'title' => $post['title'],
        'body' => mb_substr(strip_tags($post['body']), 0, 110),
        'created_at' => Date::formatYmd($post['created_at']),
        'tags' => $post['tags'],
        'dateago' => Date::getDateAgo($post['created_at']),
      ];
    }, $posts);
  }
  
  /**
   * 記事を全件取得する
   */
  public function fetchAllPosts(): array
  {
    // 複数の記事タグの結合にGROUP_CONCATを使う
    $sql_sqlite = '
      SELECT posts.*, GROUP_CONCAT(tags.tag) AS tagcsv
      FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
      GROUP BY posts.id
      ORDER BY id DESC
      ';

    // PostgreSQLではSTRING_AGGを使う
    $sql_postgres = "
      SELECT posts.*, STRING_AGG(tags.tag, ',') AS tagcsv
      FROM posts
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
      GROUP BY posts.id
      ORDER BY id DESC
      ";
    
    // DBごとにスイッチ
    $sql = (\Config::getDbType() === 'postgres')
      ? $sql_postgres
      : $sql_sqlite;

    $posts = $this->fetchAll($sql);
    
    // カンマ区切りで取得したタグを配列に展開しておく
    return array_map(function($post) {
      $post['tags'] = explode(',', $post['tagcsv']);
      return array_merge($post, $post['tags']);
    }, $posts);
  }

  /**
   * 記事を一件取得する
   */
  public function fetchPost(int $id): array
  {
    $sql_sqlite = '
      SELECT posts.*, GROUP_CONCAT(tags.tag) AS tagcsv
      FROM posts 
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
      WHERE posts.id = :id
      GROUP BY posts.id
      ';
    
    $sql_postgres = "
      SELECT posts.*, STRING_AGG(tags.tag, ',') AS tagcsv
      FROM posts 
        LEFT OUTER JOIN tags
          ON posts.id = tags.post_id
      WHERE posts.id = :id
      GROUP BY posts.id
      ";

    $sql = (\Config::getDbType() === 'postgres')
      ? $sql_postgres
      : $sql_sqlite;
    
    $post = $this->fetch($sql, [
      ':id' => $id,
    ]);
    
    $post['tags'] = explode(',', $post['tagcsv']);
    
    return $post;
  }

  /**
   * 記事を挿入する
   */
  public function insertPost(?string $title, string $body, array $tags): void
  {
    $sql_posts = '
      INSERT INTO posts
        (title, body, created_at, modified_at)
      VALUES
        (:title, :body, :created_at, :modified_at)
      ';

    $created_at = $modified_at = Date::getCurrentTime();

    $this->pdo->beginTransaction();    
    // 記事を挿入
    $this->execute($sql_posts, [':title' => $title, ':body' => $body, ':created_at' => $created_at, ':modified_at' => $modified_at]); 
    // 挿入した記事のidを取得
    $post_id = $this->getLastInsertedId();
    // タグを挿入
    $this->insertTags($post_id, $tags);
    
    $this->pdo->commit();
  }
  
  /**
   * 記事を更新する
   */
  public function updatePost(int $id, ?string $title, string $body, array $tags): void
  {
    $sql_posts = '
      UPDATE posts
      SET title = :title, body = :body, modified_at = :modified_at
      WHERE id = :id
      ';
    
    $modified_at = Date::getCurrentTime();
    
    $this->pdo->beginTransaction();
    $this->execute($sql_posts, [':id' => $id, ':title' => $title, ':body' => $body, ':modified_at' => $modified_at]);
    
    // タグの更新＝全削除して全追加
    $this->deleteTags($id);
    $this->insertTags($id, $tags);
    
    $this->pdo->commit();
  }
  
  /**
   * 記事タグを挿入する
   */
  public function insertTags(int $id, array $tags): void
  {
    $sql_tags = '
      INSERT INTO tags
        (post_id, tag)
      VALUES
        (:post_id, :tag)
    ';
    
    $stmt = $this->pdo->prepare($sql_tags);
    
    $stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
    
    foreach ($tags as $tag) {
      $stmt->bindValue(':tag', $tag, PDO::PARAM_STR);
      $stmt->execute();
    }
  }
  
  /**
   * 記事を削除する
   */
  public function deletePost(int $id): void
  {
    $sql_posts = '
      DELETE 
      FROM posts
      WHERE id = :id      
      ';
  
    $this->pdo->beginTransaction();
    $this->execute($sql_posts, [':id' => $id]);
    $this->deleteTags($id);
    
    $this->pdo->commit();
  }

  /**
   * 記事タグを削除する
   */
  public function deleteTags(int $id): void
  {
    $sql_tags = '
      DELETE 
      FROM tags 
      WHERE post_id = :id
    ';
    
    $this->execute($sql_tags, [':id' => $id]);
  }
}
