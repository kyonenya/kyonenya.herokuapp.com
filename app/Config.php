<?php
class Config
{
  // ルーティング定義
  const ROUTE_DEFINITIONS = [
    '/' => [
      'controller' => 'PostController',
      'action' => 'indexAction',
    ],
    '/articles/(?P<id>\d+)' => [
      'controller' => 'PostController',
      'action' => 'articleAction',
    ],
    '/about' => [
      'controller' => 'PageController',
      'action' => 'aboutAction',
    ],
    '/works' =>[
      'controller' => 'PageController',
      'action' => 'worksAction',
    ],
  ];

  // DB接続設定
  const SQLITE_CONFIG = [
    'dsn' => 'sqlite:../sqlite/blog',
    'user' => '',
    'password' => '',
    'options' => [],
  ];

  const POSTGRES_CONFIG = [
    'dsn' => 'pgsql:host=ec2-23-20-168-40.compute-1.amazonaws.com
      ;dbname=de9v5vgk53jcli',
    'user' => 'zxehjkojxygwch',
    'password' => '3b483c8c5a70f746ffdf7f08d600d41b6a5c59d1fb911ac7b2046a8592b9b63e',
    'options' => [],
  ];

  public static function isRewriteEngineOn(): bool
  {
    if (self::isDraftCodeEnv()) {
      return false;
    } else {
      return true;
    }
  }
  
  public static function getDbType(): string
  {    
    if (self::isHerokuEnv()) {
      return 'postgres';
    } elseif (self::isDraftCodeEnv()) {
      return 'sqlite';
    } else {
      return 'sqlite';
    }
  }
  
  public static function getDbConfig(): array
  {
    $dbType = self::getDbType();
      
    if ($dbType === 'postgres') {
      return self::POSTGRES_CONFIG;
    } elseif ($dbType === 'sqlite') {
      return self::SQLITE_CONFIG;
    }
  }

  public static function isDraftCodeEnv(): bool
  {
    return $_SERVER['SERVER_SOFTWARE'] === 'DraftCode IDE Runtime';
  }
  
  public static function isHerokuEnv(): bool
  {
    // return getenv('PHP_ENV') === 'heroku';
    return $_ENV['PHP_ENV'] === 'heroku';
  }

}