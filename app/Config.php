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

  /**
   * ApacheのRewriteRuleがオンかどうか
   * （オンなら、URLがファイルの実体（例：index.php）と対応しなくなる。）
   */  
  public static function isRewriteEngineOn(): bool
  {
    if (self::isDraftCodeEnv()) {
      return false;
    } else {
      return true;
    }
  }
  
  // DBの種類を取得（'postgres'または'sqlite'）
  public static function getDbType(): string
  {    
    if ($_ENV['DATABASE_URL']) {
      return parse_url($_ENV['DATABASE_URL'])['scheme'];  // 'postgres'
    } else {
      return 'sqlite';
    }
  }
  
  // DBの接続設定を取得
  public static function getDbConfig(): array
  {   
    if ($_ENV['DATABASE_URL']) {
      return self::parseDbConfig($_ENV['DATABASE_URL']);
    } else {
      return self::SQLITE_CONFIG;
    }
  }

  /**
   * DBの設定情報をURLを展開して生成
   * Herokuの場合など、環境変数のデータベースURLから設定を生成するときに使う。
   */
  public static function parseDbConfig(string $dbUrl) :array
  {
    // データベースURLを展開
    $urls = parse_url($dbUrl);  // [scheme, host, port, user, pass, path]
    
    $dsn = sprintf('%s:host=%s;dbname=%s', 
      $urls['scheme'],  // 'postgres'
      $urls['host'],  // 'ec2-(...).compute-1.amazonaws.com'
      ltrim($urls['path'], '/')  // データベース名
    );
    $user = $urls['user'];
    $pass = $urls['pass'];
    
    return ['dsn' => $dsn, 'user' => $user, 'pass' => $pass];
  }
  
  public static function isDraftCodeEnv(): bool
  {
    return $_SERVER['SERVER_SOFTWARE'] === 'DraftCode IDE Runtime';
  }

}

/*$_ENV['DATABASE_URL'] = 'postgres://zxehjkojxygwch:3b483c8c5a70f746ffdf7f08d600d41b6a5c59d1fb911ac7b2046a8592b9b63e@ec2-23-20-168-40.compute-1.amazonaws.com:5432/de9v5vgk53jcli';
var_dump(Config::getDbType());
var_dump(Config::getDbConfig());*/