<?php
namespace App;
require_once '../vendor/autoload.php';
require_once '../bootstrap.php';
use PHPUnit\Framework\TestCase;

class TestRouter extends TestCase
{
  protected $router;
  
  public function __construct()
  {
    $this->router = new Router();
  }
  
  public function testResolve()
  {
    $this->assertEquals($this->router->resolve(), [
    	'controller' => 'Post',
    	'action' => 'indexAction',
    	'controllerClass' => '\Controller\Post',
    	'captured' => [0 => '/'],
    ]);

    $this->assertEquals($this->router->resolve('/posts/create'), [
      'controller' => 'Post',
      'action' => 'createAction',
      'auth' => true,
      'controllerClass' => '\Controller\Post',
      'captured' => [0 => '/posts/create'],
    ]);

    $this->assertEquals($this->router->resolve('/posts/123'), [
      'controller' => 'Post',
      'action' => 'articleAction',
      'controllerClass' => '\Controller\Post',
      'captured' => [
        0 => '/posts/123',
        'id' => 123,
        1 => 123,
      ]
    ]);
  }
  
  public function __destruct()
  {
    print_r('passed');
  }
}

echo '<pre>';
$test = new TestRouter();
$test->testResolve();
