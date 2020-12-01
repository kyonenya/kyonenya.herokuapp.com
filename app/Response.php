<?php
/**
 * Responseクラス
 *
 */
namespace App;

class Response
{
  /**
   * ページを描画する
   */
  public function send(?string $html): void
  {
    http_response_code(200);  // 'OK'
    echo $html;
  }
  
  /**
   * リダイレクトする
   */
  public function redirect(string $url): void
  {
    http_response_code(302);  // 'found'
    header('Location: ' . $url);
    exit;
  }
  
  /**
   * 404ページを表示する
   */
  public function render404page($e): void
  {
    http_response_code(404);  // 'Not Found'
    echo $e->getMessage();
  }
  
  /**
   * JSONデータを返す
   */
  public function json(array $data): void
  {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('X-Content-Type-Options', 'nosniff');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
