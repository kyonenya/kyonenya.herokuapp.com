<?php
/**
 *
 *
 */
class Response 
{
  protected $statusCode = 200;  // 'OK' 
  
  public function send(?string $html): void
  {
    http_response_code($statusCode);
    if (isset($html)) {
      echo $html;
    }
  }
  
  public function render404page($e)
  {
    http_response_code(404);  // 'Not Found'
    echo $e->getMessage();
  }
}