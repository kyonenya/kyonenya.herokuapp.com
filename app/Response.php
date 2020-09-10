<?php
/**
 * Responseクラス
 *
 */
namespace App;

class Response 
{
  // protected $statusCode = 200;  // 'OK' 
  
  public function send(?string $html): void
  {
    http_response_code(200);  // 'OK'
    echo $html;
  }
  
  public function redirect(string $url): void
  {
    http_response_code(302);  // 'found'
    header('Location: ' . $url);
    exit;
  }
  
  public function render404page($e):void
  {
    http_response_code(404);  // 'Not Found'
    echo $e->getMessage();
  }
}