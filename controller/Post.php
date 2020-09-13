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

  /**
   * 新規記事をデータベースに格納する
   */
  public function storeAction(): void
  {    
    $posted = $this->getPostedPost();
    
    $this->findModel('Posts')->insertPost($posted['title'], $posted['body'], $posted['tags']);
    
    $this->response->redirect($this->baseUrl . '/');
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
   * 記事をデータベースで更新する
   */
  public function updateAction(array $captured): void
  {
    $id = $captured['id'];
    $posted = $this->getPostedPost();
      
    $this->findModel('Posts')->updatePost($id, $posted['title'], $posted['body'], $posted['tags']);

    $this->response->redirect($this->baseUrl . '/');
  }
  
  /**
   * 記事をデータベースから削除する
   */
  public function deleteAction(array $captured): void
  {
    $id = $captured['id'];
    
    $this->findModel('Posts')->deletePost($id);
    // 削除完了後、トップページに遷移
    $this->response->redirect($this->baseUrl . '/');
  }

  /**
   * POSTされた記事内容を取得する
   */
  public function getPostedPost(): array
  {
    if ($this->request->isPost() === false) {
      throw new Exception\HttpNotFound('不正なアクセスです');
    }
    // POSTされた記事内容を取得する
    $title = $this->request->getPost('title', '');
    $body = $this->request->getPost('body');
    $tagcsv = $this->request->getPost('tagcsv');
    $tags = explode(' ', $tagcsv);
    
    return ['title' => $title, 'body' => $body, 'tags' => $tags];
  }
}