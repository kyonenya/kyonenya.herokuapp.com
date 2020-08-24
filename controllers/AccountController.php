<?php

class AccountController extends Controller
{
  
  public function signupAction(array $params): string
  {
    $view = new View();
    return $view->render('message.php', $params, 'layout.php');
  }
}	