<?php
/**
 * PageController.php
 * 
 */
class PageController extends Controller
{
  // protected $config;
  // protected $view;
  
  public function aboutAction(): string
  {
    return $this->view->render('about.php', [], 'layout.php');
  }
   
  public function worksAction(): string
  {
    return $this->view->render('works.php', [], 'layout.php');
  }
  
}