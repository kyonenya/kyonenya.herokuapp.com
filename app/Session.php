<?php
/**
 * Sessionクラス
 * 
 */
class Session 
{
  protected static $isSessionStarted = false;
  
  public function __construct()
  {
    if (self::$isSessionStarted === false) {
      session_start();
      self::$isSessionStarted = true;
    }
  }
  
  public function set(string $key, string $value): void
  {
    $_SESSION[$key] = $value;
  }
  
  public function get(string $key, string $default = null): ?string
  {
    return $_SESSION[$key] 
      ?? $default;
  }
  
  
}