<?php

/*
 * DB class
 *
 * @author Luriel Mapili
 * @version 1.0
 * @date March 7, 2020
 */

namespace App;

class DB
{

  /**
   * Establish database connection
   * @return PDO 
   */
  public static function connection(): \PDO
  {
    $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME;
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
      \PDO::ATTR_PERSISTENT => true,
      \PDO::ATTR_EMULATE_PREPARES => false
    ];

    try {
      $pdo = new \PDO($dsn, USERNAME, PASSWORD, $options);
    } catch (\Exception $e) {
      die("Connection failed: {$e->getMessage()}");
    }

    return $pdo;
  }

  /**
   * Fetch a single record from the database.
   * @param string $sql
   * @param $params
   * @return 
   */
  public static function single(string $sql, array $params = [])
  {
    $stmt = self::prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
  }

  /**
   * Fetch multiple records from the database.
   * @param string $sql
   * @param $params
   * @return 
   */
  public static function all(string $sql, array $params = [])
  {
    $stmt = self::prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  /**
   * Insert or update record(s) to the database.
   * @param string $sql
   * @param $params
   * @return
   */
  public static function insert(string $sql, array $params = [])
  {
    $pdo = self::connection();
    $stmt = $pdo->prepare($sql);
    $isInserted = $stmt->execute($params);

    $isInsertQuery = strpos(strtolower($sql), 'insert') !== false;
    if ($isInsertQuery && $isInserted) {
      return $pdo->lastInsertId();
    }
    // else if UPDATE query
    return $isInserted;
  }

  /**
   * Count number of rows from the database.
   * @param string $tableName
   * @return int
   */
  public static function count(string $tableName): int
  {
    $sql = "SELECT count(*) AS rowCount FROM {$tableName}";
    return self::single($sql)->rowCount;
  }

  private function prepare(string $sql)
  {
    $pdo = self::connection();
    $stmt = $pdo->prepare($sql);
    return $stmt;
  }
}
