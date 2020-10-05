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
    //echo 'test';
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
}