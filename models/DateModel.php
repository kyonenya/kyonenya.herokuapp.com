<?php
class DateModel 
{
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
    
    return round($time) . $unit;
  }

  public static function getCurrentTime(): string
  {
    $now = new DateTimeImmutable('now');
    return $now->format('Y-m-d H:i:s');
  }
  
  public static function formatYmd(string $date): string
  {
    $d = new DateTimeImmutable($date);
    return $d->format('Y-m-d');
  }
}