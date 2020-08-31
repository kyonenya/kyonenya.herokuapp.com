<?php
/**
 * PostController.php
 * 
 */
class PostController extends Controller
{
  // protected $view;
  // protected $response;
  
  public function indexAction(): string
  {
    $posts = $this->findModel('PostsModel')->getPostlist();

    return $this->view->render('postlist.php', ['posts' => $posts], 'layout.php');
  }
  
  public function articleAction(array $params): string
  {
    $id = $params['id'];
    
    $post = $this->findModel('PostsModel')->fetchPost($id);
    
    return $this->view->render('article.php', ['post' => $post], 'layout.php');
  }

  public function deleteAction(array $params): void
  {
    $id = $params['id'];
    $this->findModel('PostsModel')->deletePost($id);
    // 削除完了後、トップページに遷移
    $this->response->redirect(Config::getBaseUrl() . '/');
  }

}