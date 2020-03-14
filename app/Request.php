<?php

namespace App;

use App\DB;

class Request
{

  /**
   * Name of the table.
   * @var string
   */
  const TABLE_NAME = 'itservices_request_tbl';


  /**
   * Request statuses
   * @var string
   */
  const POST_REPAIR_INSPECTED = 'post-repair inspected';
  const PRE_REPAIR_INSPECTED = 'pre-repair inspected';
  const ASSESSMENT_PENDING = 'assessment pending';
  const DEPLOYED = 'deployed';
  const DONE = 'done';
  const PENDING = 'pending';
  const RECEIVED = 'received';
  const ASSESSED = 'assessed';
  const PRE_POST_REPAIR_INSPECTED = 'pre-post-repair inspected';

  public static function all($limit = '')
  {
    $sql = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl 
							ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl 
							ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							LEFT JOIN hardwarecomponent_tbl 
							ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id  
							WHERE itshw_category is null 
							OR itshw_category != 'pulled-out' 
							AND itshw_category != 'walk-in' 
              ORDER BY itsrequest_date DESC 
              {$limit}";
    return DB::all($sql);
  }

  public static function find(int $id)
  {
    $sql = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl 
							ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl 
							ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							LEFT JOIN hardwarecomponent_tbl 
							ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
							WHERE itsrequest_id = ?
							LIMIT 1";
    return DB::single($sql, [$id]);
  }

  /* Get Incoming Requests by Department */
  public static function getRequestsByDepartment($dept_id, $limit = '')
  {
    $sql = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl 
							ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl 
							ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							LEFT JOIN hardwarecomponent_tbl 
							ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id
							WHERE itshw_category is null 
							OR itshw_category != 'pulled-out' 
							AND itshw_category != 'walk-in' 
							AND itservices_request_tbl.dept_id = ?
              ORDER BY itsrequest_date DESC
              {$limit}";
    return DB::all($sql, [$dept_id]);
  }

  public static function getRequestsByDate($day)
  {
    $sql = "SELECT * FROM itservices_request_tbl 
						INNER JOIN employee_tbl 
						ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
						INNER JOIN department_tbl 
						ON itservices_request_tbl.dept_id=department_tbl.dept_id 
						LEFT JOIN hardwarecomponent_tbl 
						ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id  
						WHERE itservices_request_tbl.itsrequest_date = ?
						ORDER BY itsrequest_date DESC";
    return DB::all($sql, [strtotime($day)]);
  }

  public static function getRequestsByEmployee($emp_id)
  {
    $sql = "SELECT * FROM itservices_request_tbl 
						INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
						LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
						WHERE itservices_request_tbl.emp_id = ?
						ORDER BY itsrequest_date DESC";

    return DB::all($sql, [$emp_id]);
  }

  public static function getTotalRequestsByDepartment($dept_id)
  {
    $requests = self::getRequestsByDepartment($dept_id);
    return is_array($requests) ? count($requests) : 0;
  }

  /* Add Incoming Request */
  public static function addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category)
  {
    $sql = "INSERT INTO itservices_request_tbl 
						(dept_id,emp_id,itsrequest_category,hwcomponent_id,concern,itsrequest_date,itshw_category) 
            VALUES (:dept_id,:emp_id,:itsrequest_category,:hwcomponent_id,:concern,:req_date,:itshw_category)";

    return DB::insert($sql, [
      ':dept_id' => $dept_id,
      ':emp_id' => $emp_id,
      ':itsrequest_category' => $itsrequest_category,
      ':hwcomponent_id' => $hwcomponent_id,
      ':concern' => $concern,
      ':req_date' => $req_date,
      ':itshw_category' => $itshw_category
    ]);
  }

  /*  Set Request Status to Done */
  public static function statusDoneRequest($itsrequest_id, $solution, $statusupdate_useraccount_id, $deployment_date)
  {
    $sql = "UPDATE itservices_request_tbl 
						SET status = 'done', 
						solution = :solution, 
						statusupdate_useraccount_id = :statusupdate_useraccount_id,
						deployment_date = :deployment_date
						WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':solution' => $solution,
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':deployment_date' => $deployment_date,
      ':itsrequest_id' => $itsrequest_id
    ]);
  }

  /*  Set Request Status to Go */
  public static function statusPendingRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    $sql = "UPDATE itservices_request_tbl 
            SET status = 'pending', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id 
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id' => $itsrequest_id
    ]);
  }

  /*  Set Request Status to AssessmentPending */
  public static function statusAssessmentPendingRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    // Request Set to Assessment Pending!
    $sql = "UPDATE itservices_request_tbl 
            SET 
            status = 'Assessment Pending', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id
            WHERE itsrequest_id = :itsrequest_id";
    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id'               => $itsrequest_id,
    ]);
  }

  /*  Set Request Status to Assessed */
  public static function statusAssessedRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    // Request Set to Assessed!
    $sql = "UPDATE itservices_request_tbl 
            SET status = 'Assessed', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id'               => $itsrequest_id
    ]);
  }

  /*  Set Request Status to Pre-repair Inspected */
  public static function statusPreInspectedRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    // Request Set to Pre-repair Inspected!
    $sql = "UPDATE itservices_request_tbl 
            SET status = 'Pre-repair Inspected', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id'               => $itsrequest_id
    ]);
  }

  /*  Set Request Status to Post-repair Inspected */
  public static function statusPostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    // Request Set to Post-repair Inspected!
    $sql = "UPDATE itservices_request_tbl 
            SET status = 'Post-repair Inspected', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id' => $itsrequest_id
    ]);
  }

  /*  Set Request Status to Pre and Post Repair Inspected */
  public static function statusPrePostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id)
  {
    $sql = "UPDATE itservices_request_tbl 
            SET status = 'pre-post-repair inspected', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':statusupdate_useraccount_id' => $statusupdate_useraccount_id,
      ':itsrequest_id'               => $itsrequest_id
    ]);
  }


  /*  Set Request Status to Deployed */
  public static function statusDeployedRequest($itsrequest_id, $deployment_date)
  {
    $sql = "UPDATE itservices_request_tbl 
						SET 
						status = 'deployed', 
						deployment_date = :deployment_date
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':deployment_date' => $deployment_date,
      ':itsrequest_id'   => $itsrequest_id
    ]);
  }

  /*  Set Request Hardware Category to Pulled-out */
  public static function categoryPulloutRequest($itsrequest_id, $hwcomponent_id, $property_num, $statusupdate_useraccount_id)
  {
    // Request Categorized as Pulled Out!
    $sql = "UPDATE itservices_request_tbl 
            SET itshw_category = 'pulled-out', 
            hwcomponent_id = :hwcomponent_id, 
            property_num = :property_num, 
            status = 'received', 
            statusupdate_useraccount_id = :statusupdate_useraccount_id 
            WHERE itsrequest_id = :itsrequest_id";

    return DB::insert($sql, [
      ':hwcomponent_id'   => $hwcomponent_id,
      ':property_num'   => $property_num,
      ':statusupdate_useraccount_id'   => $statusupdate_useraccount_id,
      ':itsrequest_id'   => $itsrequest_id
    ]);
  }

  public static function count(): int
  {
    return DB::count(self::TABLE_NAME);
  }
}
