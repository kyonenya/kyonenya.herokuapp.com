<?php
/**
 * Sessionクラス
 * セッションデータやログイン認証情報を管理する
 */
namespace App;

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
  
  /**
   * セッションに値をセットする
   */  
  public function set(string $key, string $value): void
  {
    $_SESSION[$key] = $value;
  }
  
  /**
   * セッションから値を取得する
   */ 
  public function get(string $key, string $default = null): ?string
  {
    return $_SESSION[$key] 
      ?? $default;
  }
    
}