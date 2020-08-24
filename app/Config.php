<?php
class Config
{
  // オブジェクト定数
  // ルーティング定義
  const ROUTE_DEFINITIONS = [
    '/' => [
      'controller' => 'PostlistController',
      'action' => 'indexAction',
    ],
    '/articles/(?P<id>\d+)' => [
      'controller' => 'PostlistController',
      'action' => 'articleAction',
    ],
    '/about' => [
      'controller' => 'PostlistController',
      'action' => 'aboutAction',
    ],
    '/works' =>[
      'controller' => 'PostlistController',
      'action' => 'worksAction',
    ],
  ];
  
  // DB接続設定
  const DB_CONFIGS = [
    'dsn' => 'pgsql:host=ec2-34-192-122-0.compute-1.amazonaws.com;dbname=detc6rc862nru9',
    'user' => 'swptknnaafikms',
    'password' => '5ba118530fe50eac1b5a15f1daaa398c5a500c86c6aefaeecc1445c2c59e5dca',
    'options' => [],
  ];

  /*  
  const DB_CONFIGS = [
    'dsn' => 'sqlite:../sqlite/blog',
    'user' => '',
    'password' => '',
    'options' => [],
  ];*/
}