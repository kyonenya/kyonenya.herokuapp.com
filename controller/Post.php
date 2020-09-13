<?php
/**
 * Postコントローラー
 * 
 */
namespace Controller;

class Post extends Controller
{
  /**
   * 記事一覧ページを表示する
   */
  public function indexAction(): string
  {
    $posts = $this->findModel('Posts')->getPostlist();

    return $this->view->render('postlist.php', ['posts' => $posts], 'layout.php');
  }
  
  /**
   * 個別記事ページを表示する
   */
  public function articleAction(array $captured): string
  {
    $id = $captured['id'];
    
    $post = $this->findModel('Posts')->fetchPost($id);
    
    return $this->view->render('article.php', ['post' => $post], 'layout.php');
  }
  
  /**
   * 新規記事作成ページを表示する
   */
  public function createAction(): string
  {
    return $this->view->render('editor.php', [], 'layout.php');
  }

  public function storeAction(): void
  {
    // POST以外のアクセスを弾く
    if ($this->request->isPost() === false) {
      throw new Exception\HttpNotFound('不正なアクセスです');
    }
    // POST内容を取得してinsert文を実行する
    $title = $this->request->getPost('title', '');
    $body = $this->request->getPost('body');
    $tagcsv = $this->request->getPost('tagcsv');
    $tags = explode(' ', $tagcsv);
    
    $this->findModel('Posts')->insertPost($title, $body, $tags);
    
    $this->response->redirect(\Config::getBaseUrl() . '/');
  }
  
  /**
   * 記事編集ページを表示する
   */
  public function editAction(array $captured): string
  {
    $id = $captured['id'];
    
    $post = $this->findModel('Posts')->fetchPost($id);
    $post['tagcsv'] = implode(' ', $post['tags']);
    
    return $this->view->render('editor.php', ['post' => $post], 'layout.php');
  }

  /**
   * 記事を更新する
   */
  public function updateAction(array $captured): void
  {
    $id = $captured['id'];
    
    if ($this->request->isPost() === false) {
      throw new Exception\HttpNotFound('不正なアクセスです');
    }
    // POST内容を取得してupdate文を実行する
    $title = $this->request->getPost('title', '');
    $body = $this->request->getPost('body');
    $tagcsv = $this->request->getPost('tagcsv');
    $tags = explode(' ', $tagcsv);
    
    $this->findModel('Posts')->updatePost($id, $title, $body, $tags);

    $this->response->redirect(Config::getBaseUrl() . '/');
  }
  
  /**
   * 記事を削除する
   */
  public function deleteAction(array $captured): void
  {
    $id = $captured['id'];
    
    $this->findModel('Posts')->deletePost($id);
    // 削除完了後、トップページに遷移
    $this->response->redirect(Config::getBaseUrl() . '/');
  }

}