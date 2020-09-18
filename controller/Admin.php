<?php
/**
 * Adminコントローラー
 * 
 */
namespace Controller;

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
      $this->response->redirect(\Config::getBaseUrl() . '/admin/login');
    }
    
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

}