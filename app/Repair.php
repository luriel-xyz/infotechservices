<?php

namespace App;

use App\DB;

class Repair
{

  const TABLE_NAME = 'itservices_request_tbl';

  public static function all(string $limit = '')
  {
    $sql = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							INNER JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
							WHERE itshw_category != 'on-site' AND itshw_category is NOT NULL 
              ORDER BY itsrequest_date DESC
              {$limit}";
    return DB::all($sql);
  }

  public static function find(int $id): Object
  {
    $sql = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl 
							ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl 
							ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							LEFT JOIN hardwarecomponent_tbl 
							ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
							WHERE itsrequest_id = ?";
    return DB::single($sql, [$id]);
  }

  /* Get Incoming Repair by Department */
  public static function getRepairsByDepartment($dept_id)
  {
    $sql = "SELECT * FROM itservices_request_tbl 
						INNER JOIN employee_tbl 
						ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
						INNER JOIN department_tbl 
						ON itservices_request_tbl.dept_id=department_tbl.dept_id 
						LEFT JOIN hardwarecomponent_tbl 
						ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
						WHERE itshw_category != 'on-site' 
						AND itshw_category is NOT NULL 
						AND itservices_request_tbl.dept_id = ?
						ORDER BY itsrequest_date DESC";
    return DB::all($sql, [$dept_id]);
  }

  /* Get Incoming Repair by Date */
  public static function getRepairByDate($itsrequest_date)
  {

    $sql = "SELECT * FROM itservices_request_tbl 
            INNER JOIN employee_tbl 
            ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
            INNER JOIN department_tbl 
            ON itservices_request_tbl.dept_id=department_tbl.dept_id 
            LEFT JOIN hardwarecomponent_tbl 
            ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
            WHERE itshw_category != 'on-site' 
            AND itshw_category is NOT NULL 
            AND itservices_request_tbl.itsrequest_date = ?
            ORDER BY itsrequest_date DESC";
    return DB::all($sql, [$itsrequest_date]);
  }


  /* Add Repairs */
  public static function addRepair($dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_sub_id, $property_num, $concern, $statusupdate_useraccount_id, $itsrequest_date)
  {
    $sql = "INSERT INTO itservices_request_tbl 
						(dept_id,emp_id,itsrequest_category,itshw_category,hwcomponent_id,hwcomponent_sub_id,property_num,concern,statusupdate_useraccount_id,itsrequest_date) 
						VALUES (
							:dept_id,
							:emp_id,
							:itsrequest_category,
							:itshw_category,
							:hwcomponent_id,
							:hwcomponent_sub_id,
							:property_num,
							:concern,
							:statusupdate_useraccount_id,
							:itsrequest_date
            )";

    return DB::insert($sql, [
      ':dept_id' => $dept_id,
      ':emp_id' => $emp_id,
      ':itsrequest_category' => $itsrequest_category,
      ':itshw_category' => $itshw_category,
      ':hwcomponent_id' => $hwcomponent_id,
      ':hwcomponent_sub_id' => $hwcomponent_sub_id,
      ':property_num' => $property_num,
      ':concern' => $concern,
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_date' => $itsrequest_date
    ]);
  }

  public static function count(): int
  {
    return DB::count(self::TABLE_NAME);
  }
}
