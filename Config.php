<?php
/**
 * Configクラス
 * アプリごとの設定や環境変数、グローバル設定の管理
 */
class Config
{
  // ルーティング定義
  const ROUTE_DEFINITIONS = [
    '/' => [
      'controller' => 'PostController',
      'action' => 'indexAction',
    ],
    '/posts/(?P<id>\d+)' => [
      'controller' => 'PostController',
      'action' => 'articleAction',
    ],
    '/posts/create' => [
      'controller' => 'PostController',
      'action' => 'createAction',
    ],
    '/posts/store' => [
      'controller' => 'PostController',
      'action' => 'storeAction',
    ],
    '/posts/edit/(?P<id>\d+)' => [
      'controller' => 'PostController',
      'action' => 'editAction',
    ],
    '/posts/update/(?P<id>\d+)' => [
      'controller' => 'PostController',
      'action' => 'updateAction',
    ],
    '/posts/delete/(?P<id>\d+)' => [
      'controller' => 'PostController',
      'action' => 'deleteAction',
    ],
    '/admin' =>[
      'controller' => 'AdminController',
      'action' => 'indexAction',
    ],
    '/admin/login' =>[
      'controller' => 'AdminController',
      'action' => 'loginAction',
    ],
    '/admin/auth' =>[
      'controller' => 'AdminController',
      'action' => 'authAction',
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
    'pass' => '',
  ];

  // DBの種類を取得（'postgres'または'sqlite'）
  public static function getDbType(): string
  {  
    if ($_ENV['DATABASE_URL']) {
      // データベースURLからスキームを取得して返す
      return parse_url($_ENV['DATABASE_URL'])['scheme'];  // 'postgres'
    } else {
      return 'sqlite';
    }
  }
  
  // DBの接続設定を取得
  public static function getDbConfig(): array
  {   
    if ($_ENV['DATABASE_URL']) {
      return self::convertDbUrl($_ENV['DATABASE_URL']);
    } else {
      return self::SQLITE_CONFIG;
    }
  }

  // データベースURLをPDO接続用の設定に変換
  public static function convertDbUrl(string $dbUrl) :array
  {
    // データベースURLを展開
    $urls = parse_url($dbUrl);  // [scheme, host, port, user, pass, path]
    
    $dsn = sprintf('pgsql:host=%s;dbname=%s',
      $urls['host'],  // 'ec2-(...).compute-1.amazonaws.com'
      ltrim($urls['path'], '/')  // データベース名
    );
    $user = $urls['user'];
    $pass = $urls['pass'];
    
    return ['dsn' => $dsn, 'user' => $user, 'pass' => $pass];
  }
  
  /**
   * ベースURLを取得
   * リクエストURIのうち、パス情報を除いた無意味な部分。
   * プロジェクト全体で共通なので、RequestクラスではなくConfigクラスで保持。
   * 例）'/index.php'
   */
  public static function getBaseUrl(): ?string
  {
    if (self::isRewriteEngineOn()) {
      // ドキュメントルート直下にindex.phpを置く場合
      return '';
    } else {
      // クエリ文字列でパス情報を代用する場合
      return $_SERVER['SCRIPT_NAME'] . '?l=';  // '/index.php?l='
    }
  }
  
  // ApacheのRewriteEngineがオンかどうか
  public static function isRewriteEngineOn(): bool
  {
    // DraftCode環境においてのみオフ
    if (self::isDraftCodeEnv()) {
      return false;
    } else {
      return true;
    }
  }

  // 実行環境がiPadアプリのDrafCodeであるかどうか
  public static function isDraftCodeEnv(): bool
  {
    return $_SERVER['SERVER_SOFTWARE'] === 'DraftCode IDE Runtime';
  }

}