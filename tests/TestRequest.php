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
  
  public function testIsPost()
  {
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
