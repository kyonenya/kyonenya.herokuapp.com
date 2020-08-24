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

/*  const DB_CONFIGS = [
    'dsn' => 'sqlite:../sqlite/blog',
    'user' => '',
    'password' => '',
    'options' => [],
  ];*/

  const DB_CONFIGS = [
    'dsn' => 'pgsql:host=ec2-23-20-168-40.compute-1.amazonaws.com
      ;dbname=de9v5vgk53jcli',
    'user' => 'zxehjkojxygwch',
    'password' => '3b483c8c5a70f746ffdf7f08d600d41b6a5c59d1fb911ac7b2046a8592b9b63e',
    'options' => [],
  ];
 
}