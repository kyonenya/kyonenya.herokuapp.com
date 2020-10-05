<?php
namespace App\Exception;
/**
 * ログインが必要だがまだされていない場合、またはログインに失敗した場合
 */
class Unauthorized extends \Exception
{
};