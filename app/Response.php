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
    if ($html) {
      echo $html;
    }
  }
}