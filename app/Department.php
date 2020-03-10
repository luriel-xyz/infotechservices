<?php

namespace App;

use App\DB;

class Department
{

  const TABLE_NAME = 'department_tbl';

  public static function getDepartment($dept_id = null)
  {
    if ($dept_id == null) {
      $sql = "SELECT * FROM department_tbl";
      return DB::all($sql);
    } else {
      $sql = "SELECT * FROM department_tbl 
							WHERE dept_id = ? 
							LIMIT 1";
      return DB::single($sql, [$dept_id]);
    }
  }

  /* Add Department */
  public static function addDepartment($dept_code, $dept_name)
  {
    $sql = "INSERT INTO department_tbl (dept_code,dept_name) 
            VALUES (:dept_code,:dept_name)";

    return DB::insert($sql, [
      ':dept_code' => $dept_code,
      ':dept_name' => $dept_name
    ]);
  }

  /* Update Department */
  public static function updateDepartment($dept_id, $dept_code, $dept_name)
  {
    $sql = "UPDATE department_tbl 
						SET 
						dept_code = :dept_code, 
						dept_name = :dept_name 
            WHERE dept_id = :dept_id";

    return DB::insert($sql, [
      ':dept_code'  => $dept_code,
      ':dept_name'  => $dept_name,
      ':dept_id'    => $dept_id
    ]);
  }

  public static function count(): int
  {
    return DB::count(self::TABLE_NAME);
  }
}
