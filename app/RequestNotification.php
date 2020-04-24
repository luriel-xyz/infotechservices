<?php

namespace App;

use App\DB;

class RequestNotification
{

  const TABLE_NAME = 'request_notifications';

  public static function create($requestsTotal)
  {
    $sql = "INSERT INTO " . self::TABLE_NAME . " (requests_total) VALUES (?)";
    return DB::insert($sql, [$requestsTotal]);
  }

  public static function update($requestsTotal)
  {
    $sql = "UPDATE " . self::TABLE_NAME . " SET requests_total = ?";
    return DB::insert($sql, [$requestsTotal]);
  }

  public static function last()
  {
    $sql = "SELECT requests_total FROM " . self::TABLE_NAME . " ORDER BY id DESC LIMIT 1";

    return DB::single($sql);
  }

  public static function count()
  {
    return DB::count(self::TABLE_NAME);
  }

  public static function truncate()
  {
    return DB::truncate(self::TABLE_NAME);
  }
}
