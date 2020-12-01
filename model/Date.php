<?php
/**
 * Dateモデル
 * 日付・時刻の処理
 */
namespace Model;

use DateTimeImmutable;

class Date
{
  /**
   * 何日前・何ヶ月前などを計算する
   */
  public static function getDateAgo($time)
  {
    $date = new DateTimeImmutable($time);
    $now = new DateTimeImmutable('now');
    
    $diff = $now->getTimestamp() - $date->getTimestamp();
    
    if ($diff < 60) {
      $time   = $diff;
      $unit   = '秒前';
    } elseif ($diff < 60 * 60) {
      $time   = $diff / 60;
      $unit   = '分前';
    } elseif ($diff < 3600 * 12) {
      $time   = $diff / 3600;
      $unit   = '時間前';
    } elseif ($diff < 86400 * 31) {
      $time   = $diff / 86400;
      $unit   = '日前';
    } elseif ($diff < 2764800 * 12) {
      $time   = $diff / 2764800;
      $unit   = 'ヶ月前';
    } else {
      $time = ($diff / 2764800) / 12;
      $unit = '年前';
    }
    // 四捨五入
    return round($time) . $unit;
  }

  /**
   * 現在時刻を秒数まで取得
   * 例）2020-09-13 15:42:33
   */
  public static function getCurrentTime(): string
  {
    $now = new DateTimeImmutable('now');
    return $now->format('Y-m-d H:i:s');
  }
  
  /**
   * 日付までに変換
   * 例）2020-09-13
   */
  public static function formatYmd(string $date): string
  {
    $d = new DateTimeImmutable($date);
    return $d->format('Y-m-d');
  }
}
