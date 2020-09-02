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
        $unit   = "秒前";
    }
    elseif ($diff < 3600) {
        $time   = $diff/60;
        $unit   = "分前";
    }
    elseif ($diff < 86400) {
        $time   = $diff/3600;
        $unit   = "時間前";
    }
    elseif ($diff < 2764800) {
        $time   = $diff/86400;
        $unit   = "日前";
    } 
    elseif ($diff < 2764800 * 12) {
        $time   = $diff/2764800;
        $unit   = "ヶ月前";
    } 
    else {
        $time = ($diff/2764800) / 12;
        $unit = '年前';
    }
    return (int)$time . $unit;
  }

}