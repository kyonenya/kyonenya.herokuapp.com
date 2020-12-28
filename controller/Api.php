<?php
namespace Controller;

use \App\Exception;

/**
 * Apiコントローラー
 *
 */
class Api extends Controller
{
  /**
   * 記事を全件配信する
  http://127.0.0.1/kyonenya.herokuapp.com/web/index.php?l=/api/posts
   */
  public function getAllPostsAction()
  {
    $posts = $this->findModel('Posts')->fetchAllPosts();
    $data = array_map(function ($post) {
      return [
        'id' => $post['id'],
        'date' => $post['created_at'],
        'title' => $post['title'],
        'text' => $post['body'],
        'tags' => $post['tags'],
      ];
    }, $posts);
    $this->response->json($data);
  }
  
  public function jsonAction(): void
  {
    $file = dirname(__FILE__) . '/../web/data/manuscripts_201228.json';
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    $this->findModel('Manuscripts')->insertEntries($data['entries']);
  }
}
