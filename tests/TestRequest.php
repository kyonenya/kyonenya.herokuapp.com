<?php
namespace App;
require_once '../vendor/autoload.php';
require_once '../bootstrap.php';
use PHPUnit\Framework\TestCase;

class TestRequest extends TestCase
{
  protected $request;
  
  public function __construct()
  {
    $this->request = new Request();
  }
  
  public function testGetPathInfo()
  {
    $_GET = ['l' => '/posts/123'];
    $this->assserEquals('/posts/123', $this->request->getPathInfo());
    
    $_SERVER['PATH_INFO'] = '/posts/123';
    $this->assserEquals('/posts/123', $this->request->getPathInfo());
  }
  public function testGetRequestUri()
  {
    $_SERVER['REQUEST_URI'] = '/index.php/posts/123';
    $this->assertEquals('/index.php/posts/123', $this->request->getRequestUri());

    // if contains get parameter '?'
    $_SERVER['REQUEST_URI'] = '/index.php/posts?id=123';
    $this->assertEquals('/index.php/posts', $this->request->getRequestUri());
  }
  
  public function testIsPost()
  {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $this->assertEquals(false, $this->request->isPost());
    
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $this->assertEquals(true, $this->request->isPost());
  }
  
  public function __destruct()
  {
    print_r('passed');
    $_SERVER = [];
  }
}

$test = new TestRequest();
$test->testIsPost();
$test->testGetRequestUri();
