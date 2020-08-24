<?php

class PostlistController extends Controller
{
  // protected $config;
  // protected $view;

  public function indexAction(): string
  {
    $posts = $this->findModel('PostsModel')->fetchAllPostlists();

    return $this->view->render('postlist.php', ['posts' => $posts], 'layout.php');
  }
  
  public function articleAction(array $params): string
  {
    $id = $params['id'];
    
    $post = $this->findModel('PostsModel')->fetchArticle($id);
    
    $post['tags'] = $this->findModel('TagsModel')->fetchTags($id);
    
    return $this->view->render('article.php', ['post' => $post], 'layout.php');
  }
  
  public function aboutAction(): string
  {
    return $this->view->render('about.php', [], 'layout.php');
  }
   
  public function worksAction(): string
  {
    return $this->view->render('works.php', [], 'layout.php');
  }
}