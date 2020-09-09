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
  
  public function articleAction(array $captured): string
  {
    $id = $captured['id'];
    
    $post = $this->findModel('PostsModel')->fetchPost($id);
    
    return $this->view->render('article.php', ['post' => $post], 'layout.php');
  }
  
  public function createAction(): string
  {
    return $this->view->render('editor.php', [], 'layout.php');
  }

  public function storeAction(): void
  {
    // POST以外のアクセスを弾く
    if ($this->request->isPost() === false) {
      throw new HttpNotFoundException('不正なアクセスです');
    }
    // POST内容を取得してinsert文を実行
    $title = $this->request->getPost('title', '');
    $body = $this->request->getPost('body');
    $tagcsv = $this->request->getPost('tagcsv');
    $tags = explode(' ', $tagcsv);
    
    $this->findModel('PostsModel')->insertPost($title, $body, $tags);
    
    $this->response->redirect(Config::getBaseUrl() . '/');
  }

  public function editAction(array $captured): string
  {
    $id = $captured['id'];
    
    $post = $this->findModel('PostsModel')->fetchPost($id);
    $post['tagcsv'] = implode(' ', $post['tags']);
    
    return $this->view->render('editor.php', ['post' => $post], 'layout.php');
  }
  
  public function updateAction(array $captured): void
  {
    $id = $captured['id'];
    
    if ($this->request->isPost() === false) {
      throw new HttpNotFoundException('不正なアクセスです');
    }
    // POST内容を取得してinsert文を実行
    $title = $this->request->getPost('title', '');
    $body = $this->request->getPost('body');
    $tagcsv = $this->request->getPost('tagcsv');
    $tags = explode(' ', $tagcsv);
    
    $this->findModel('PostsModel')->updatePost($id, $title, $body, $tags);

    $this->response->redirect(Config::getBaseUrl() . '/');
  }
  
  public function deleteAction(array $captured): void
  {
    $id = $captured['id'];
    
    $this->findModel('PostsModel')->deletePost($id);
    // 削除完了後、トップページに遷移
    $this->response->redirect(Config::getBaseUrl() . '/');
  }

}