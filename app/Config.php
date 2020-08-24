<?php
class Config
{
  // オブジェクト定数
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
  $url = parse_url(getenv('DATABASE_URL'));
  $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
  
  const DB_CONFIGS = [
    'dsn' => $dsn,
    'user' => $url['user'],
    'password' => $url['pass'],
    'options' => [],
  ];

/*  const DB_CONFIGS = [
    'dsn' => 'sqlite:../sqlite/blog',
    'user' => '',
    'password' => '',
    'options' => [],
  ];*/
}