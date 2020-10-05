<?php
namespace Controller;
use \App\Exception;
/**
 * Adminコントローラー
 * 
 */
class Admin extends Controller
{
  /**
   * ログインページを表示する
   */
  public function loginAction()
  {
    return $this->view->render('login.php', [], 'layout.php');
  }
  
  /**
   * 
   * 
   */
  public function authAction()
  {
    $password = $this->request->getPost('password');
    $isValid = password_verify($password, \Config::getPassword());

    if (!$isValid) {
      throw new Exception\Unauthorized();
    }
    
    // セッションIDを再生成し、既存のセッションを破棄する（セッションハイジャック対策）
    session_regenerate_id(true);
    $this->session->set('auth', true);    
    $this->response->redirect(\Config::getBaseUrl() . '/admin');
  }
 
  /**
   * 
   * 
   */
  public function indexAction()
  {
    // if (empty($this->session->get('auth'))) {
    //   $this->response->redirect(\Config::getBaseUrl() . '/admin/login');
    // }
    return $this->view->render('admin.php', [], 'layout.php');
  } 

  /**
   * ログアウトする
   */
  public function logoutAction(): void
  {
    // セッション変数を空にする
    $_SESSION = [];
    // ブラウザ側のセッションIDを破棄させる
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 86400, '/');
    }
    // セッションIDを破棄する
    session_destroy();

    $this->response->redirect($this->baseUrl . '/');
  }
}