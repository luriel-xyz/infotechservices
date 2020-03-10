<?php

namespace App;

use App\DB;

class Employee
{

  const TABLE_NAME = 'employee_tbl';

  public static function isIdNumberTaken($idNumber): bool
  {
    $sql = 'SELECT count(*) AS frequency 
            FROM employee_tbl 
            WHERE emp_idnum = ?';

    $isTaken = DB::single($sql, [$idNumber])->frequency ? true : false;
    return $isTaken;
  }

  public static function all(string $limit = '')
  {
    $sql = "SELECT * FROM employee_tbl 
            INNER JOIN department_tbl 
            ON employee_tbl.dept_id=department_tbl.dept_id 
            {$limit}";

    return DB::all($sql);
  }

  public static function find($id): Object
  {
    $sql = "SELECT * FROM employee_tbl 
							INNER JOIN department_tbl 
							ON employee_tbl.dept_id=department_tbl.dept_id 
							WHERE emp_id = ?";
    return DB::single($sql, [$id]);
  }

  /*  Get Employee By Department */
  public static function getEmployeesByDepartment($dept_id = null)
  {
    $sql = "SELECT * FROM employee_tbl WHERE dept_id = ?";
    return DB::all($sql, [$dept_id]);
  }

  /* Add Employee */
  public static function create($dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position)
  {
    $sql = "INSERT INTO employee_tbl 
						(dept_id,emp_idnum,emp_fname,emp_lname,emp_position) 
						VALUES (:dept_id,:emp_idnum,:emp_fname,:emp_lname,:emp_position)";

    return DB::insert($sql, [
      ':dept_id' => $dept_id,
      ':emp_idnum' => $emp_idnum,
      ':emp_fname' => $emp_fname,
      ':emp_lname' => $emp_lname,
      ':emp_position' => $emp_position
    ]);
  }

  /* Update Employee */
  public static function updateEmployee($emp_id, $dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position)
  {
    $sql = "UPDATE employee_tbl 
						SET 
						dept_id = :dept_id, 
						emp_idnum = :emp_idnum, 
						emp_fname = :emp_fname, 
						emp_lname = :emp_lname,
						emp_position = :emp_position 
            WHERE emp_id = :emp_id";

    return DB::insert($sql, [
      ':dept_id' => $dept_id,
      ':emp_idnum' => $emp_idnum,
      ':emp_fname' => $emp_fname,
      ':emp_lname' => $emp_lname,
      ':emp_position' => $emp_position,
      ':emp_id' => $emp_id
    ]);
  }

  public static function count(): int
  {
    return DB::count(self::TABLE_NAME);
  }
}
