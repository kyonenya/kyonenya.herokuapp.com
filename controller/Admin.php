<?php
/**
 * Adminコントローラー
 * 
 */
namespace Controller;

class AdminController extends Controller
{
  /**
   * 
   * 
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
    if (true) {  // TODO パスワード認証
      $this->session->set('auth', true);
    }
    
    $this->response->redirect(\Config::getBaseUrl() . '/admin');
  }
 
  /**
   * 
   * 
   */
  public function indexAction()
  {
    if (empty($this->session->get('auth'))) {
      $this->response->redirect(\Config::getBaseUrl() . '/admin/login');
    }
    return $this->view->render('admin.php', [], 'layout.php');
  } 
}