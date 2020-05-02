<?php

namespace App;

use App\DB;

class User
{

  const TABLE_NAME = 'useraccount_tbl';

  public static function create($username, $password)
  {
    $sql = "INSERT INTO useraccount_tbl (username, password)
						VALUES (:username, :password)";

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    return DB::insert($sql, [
      ':username' => $username,
      ':password' => $hashed
    ]);
  }

  public static function userNameExists($username)
  {
    $sql = "SELECT count(*) 
            AS frequency 
            FROM useraccount_tbl
            WHERE username = ?";
    return DB::single($sql, [$username])->frequency > 0;
  }

  public static function departmentAccountExists($dept_id)
  {
    $sql = "SELECT count(*) 
            AS frequency 
            FROM useraccount_tbl
            WHERE dept_id = ?
            LIMIT 1";
    return DB::single($sql, [$dept_id])->frequency > 0;
  }

  public static function all($limit = '')
  {
    $sql = "SELECT * FROM useraccount_tbl 
							LEFT JOIN employee_tbl 
							ON useraccount_tbl.emp_id=employee_tbl.emp_id 
							LEFT JOIN department_tbl 
              ON useraccount_tbl.dept_id=department_tbl.dept_id
              {$limit}";
    return DB::all($sql);
  }

  public static function find($id)
  {
    $sql = "SELECT * FROM useraccount_tbl 
							LEFT JOIN employee_tbl 
							ON useraccount_tbl.emp_id=employee_tbl.emp_id 
							LEFT JOIN department_tbl 
							ON useraccount_tbl.dept_id=department_tbl.dept_id 
              WHERE useraccount_tbl.useraccount_id = ?";

    return DB::single($sql, [$id]);
  }

  /* Add Department User Account */
  public static function addDepartmentUserAccount($usertype, $dept_id, $emp_id, $username, $password)
  {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $status = 1;

    $sql = "INSERT INTO useraccount_tbl (usertype,dept_id,emp_id,username,password,status) VALUES (?,?,?,?,?,?)";
    return DB::insert($sql, [
      'usertype' => $usertype,
      'dept_id' => $dept_id,
      'emp_id' => $emp_id,
      'username' => $username,
      'password' => $hashedPassword,
      'status' => $status,
    ]);
  }

  // public static function accountExists($username)
  // {
  // 	$sql = "SELECT * FROM useraccount_tbl
  // 			WHERE username = " . $username . " LIMIT 1";
  // 	$result = $this->db->query($sql);
  // 	var_dump($result);
  // 	die;
  // }

  /* Add Personnel User Account */
  public static function addPersonnelUserAccount($usertype, $emp_id, $username, $password)
  {

    $status = 1;
    $enc_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO useraccount_tbl (usertype,emp_id,username,password,status) VALUES (?,?,?,?,?)";
    return DB::insert($sql, [$usertype, $emp_id, $username, $enc_password, $status]);
  }

  /* Update User Account */
  public static function updateUserAccount($useraccount_id, $usertype, $username, $emp_id, $dept_id)
  {
    if ($usertype == 'department') {
      $sql = "UPDATE useraccount_tbl 
							SET 
							username = :username, 
							usertype = :usertype, 
							dept_id = :dept_id 
							WHERE useraccount_id = :useraccount_id";
      return DB::insert($sql, [
        ':username' => $username,
        ':usertype' => $usertype,
        ':dept_id' => $dept_id,
        ':useraccount_id' => $useraccount_id
      ]);
    } else {
      $sql = "UPDATE useraccount_tbl 
							SET 
							username = :username, 
							usertype = :usertype, 
							emp_id = :emp_id 
							WHERE useraccount_id = :useraccount_id";
      return DB::insert($sql, [
        ':username' => $username,
        ':usertype' => $usertype,
        ':emp_id' => $emp_id,
        ':useraccount_id' => $useraccount_id
      ]);
    }
  }

  /*  Disable User Account Access */
  public static function disableUserAccount($useraccount_id)
  {
    $sql = "UPDATE useraccount_tbl 
						SET status = 0 
            WHERE useraccount_id = ?";
    return DB::insert($sql, [$useraccount_id]);
  }

  /*  Enable User Account Access */
  public static function enableUserAccount($useraccount_id)
  {
    $sql = "UPDATE useraccount_tbl 
						SET status = 1 
						WHERE useraccount_id = ?";
    return DB::insert($sql, [$useraccount_id]);
  }

  public static function count(): int
  {
    return DB::count(self::TABLE_NAME);
  }
}
