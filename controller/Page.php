<?php
/**
 * PageController.php
 * 
 */
namespace Controller;

class PageController extends Controller
{
  /**
   * 
   * 
   */  
  public function aboutAction(): string
  {
    return $this->view->render('about.php', [], 'layout.php');
  }
   
  /**
   * 
   * 
   */
  public function worksAction(): string
  {
    return $this->view->render('works.php', [], 'layout.php');
  }
  
}