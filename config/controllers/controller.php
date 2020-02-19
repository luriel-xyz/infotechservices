<?php

/* File containing all query functions */

class Controller
{

	/**  LOGIN  **/

	/*  Check Login Credentials  */
	public function login($username, $password)
	{
		global $con;

		$username = mysqli_real_escape_string($con, $username);
		$password = mysqli_real_escape_string($con, $password);

		$qry = "SELECT * FROM useraccount_tbl 
				LEFT JOIN employee_tbl 
				ON useraccount_tbl.emp_id=employee_tbl.emp_id 
				LEFT JOIN department_tbl 
				ON useraccount_tbl.dept_id=department_tbl.dept_id 
				WHERE username = '{$username}'
				AND password = '" . md5($password) . "'";

		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows === 1) {
				$login = array();
				while ($row = $result->fetch_assoc()) {
					$login[] = $row;
				}
				foreach ($login as $value) {
					$user = $value['username'];
				}
				$check = strcmp($username, $user);
				if ($check !== 0) {
					return false;
				} else {
					return $login;
				}
			} else {
				return $result->num_rows;
			}
		}
	}


	/**  DEPARTMENT  **/

	/*  Get Department*/
	public function getDepartment($dept_id = null)
	{
		global $con;

		if ($dept_id == null) {
			$qry = "SELECT * FROM department_tbl";
			if ($con->query($qry)) {
				$result1 = $con->query($qry);
				if ($result1->num_rows == 0) {
					return $result1->num_rows;
				}

				$depts = array();

				while ($row = $result1->fetch_assoc()) {
					$depts[] = $row;
				}

				return $depts;
			} else {
				return false;
			}
		} else {

			$qry = "SELECT * FROM department_tbl WHERE dept_id = '" . $dept_id . "' ";

			if ($con->query($qry)) {
				$result1 = $con->query($qry);
				if ($result1->num_rows == 0) {
					return 0;
				}
				$depts = array();
				while ($row = $result1->fetch_assoc()) {
					$depts[] = $row;
				}
				return $depts;
			} else {
				return false;
			}
		}
	}

	/* Add Department */
	public function addDepartment($dept_code, $dept_name)
	{
		global $con;

		$msg = "Please try again!";

		$qry = $con->prepare("INSERT INTO department_tbl (dept_code,dept_name) VALUES (?,?)");
		$qry->bind_param('ss', $dept_code, $dept_name);
		if ($qry->execute()) {
			$msg = "Department Added!";
		}
		return $msg;
	}

	/* Update Department */
	public function updateDepartment($dept_id, $dept_code, $dept_name)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE department_tbl SET dept_code = '" . $dept_code . "', dept_name = '" . $dept_name . "' WHERE dept_id = '" . $dept_id . "'";
		if ($con->query($qry)) {
			$msg = " Department Updated!";
		}
		return $msg;
	}


	/**  EMPLOYEE  **/

	/*  Get Employee */
	public function getEmployee($emp_id = null)
	{
		global $con;

		if ($emp_id == null) {
			$qry = "SELECT * FROM employee_tbl INNER JOIN department_tbl ON employee_tbl.dept_id=department_tbl.dept_id";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				$users = array();
				while ($row = $result->fetch_assoc()) {
					$users[] = $row;
				}
				return $users;
			} else {
				return false;
			}
		} else {
			$qry = "SELECT * FROM employee_tbl INNER JOIN department_tbl ON employee_tbl.dept_id=department_tbl.dept_id WHERE emp_id = '" . $emp_id . "' ";

			if ($con->query($qry)) {
				$result = $con->query($qry);
				return $result->fetch_assoc();
			} else {
				return false;
			}
		}
	}

	/*  Get Employee By Department */
	public function getEmployeesByDepartment($dept_id = null)
	{
		global $con;

		$qry = "SELECT * FROM employee_tbl WHERE dept_id = '" . $dept_id . "'";

		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows == 0) {
				return 0;
			}
			$users = array();
			while ($row = $result->fetch_assoc()) {
				$users[] = $row;
			}
			return $users;
		} else {
			return false;
		}
	}

	/* Add Employee */
	public function addEmployee($dept_id, $emp_idnum, $emp_fname, $emp_lname)
	{
		global $con;

		$msg = "Please try again!";

		$qry = $con->prepare("INSERT INTO employee_tbl (dept_id,emp_idnum,emp_fname,emp_lname) VALUES (?,?,?,?)");
		$qry->bind_param('isss', $dept_id, $emp_idnum, $emp_fname, $emp_lname);
		if ($qry->execute()) {
			$msg = "Employee Added!";
		}
		return $msg;
	}

	/* Update Employee */
	public function updateEmployee($emp_id, $dept_id, $emp_idnum, $emp_fname, $emp_lname)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE employee_tbl SET dept_id = '" . $dept_id . "', emp_idnum = '" . $emp_idnum . "', emp_fname = '" . $emp_fname . "', emp_lname = '" . $emp_lname . "' WHERE emp_id = '" . $emp_id . "'";
		if ($con->query($qry)) {
			$msg = " Employee Updated!";
		}
		return $msg;
	}


	/**  HARDWARE COMPONENTS  **/

	/*  Get Hardware Components */
	public function getHardwareComponents($hwcomponent_id = null)
	{
		global $con;

		if ($hwcomponent_id == null) {
			$qry = "SELECT * FROM hardwarecomponent_tbl";

			$result = $con->query($qry);
			if ($result) {
				$components = array();
				while ($row = $result->fetch_assoc()) {
					$components[] = $row;
				}
				return $components;
			} else {
				return false;
			}
		} else {
			$qry = "SELECT * FROM hardwarecomponent_tbl WHERE hwcomponent_id = '" . $hwcomponent_id . "' ";

			$result = $con->query($qry);
			return $result ? $result->fetch_assoc() : false;
		}
	}

	/*  Get Hardware Components by Category */
	public function getHardwareComponentsByCategory($hwcomponent_type)
	{
		global $con;

		$qry = "SELECT * FROM hardwarecomponent_tbl WHERE hwcomponent_type = '" . $hwcomponent_type . "' ";

		if ($con->query($qry)) {

			$result1 = $con->query($qry);
			if ($result1->num_rows == 0) {
				return $result1->num_rows;
			}

			$components = array();

			while ($row = $result1->fetch_assoc()) {
				$components[] = $row;
			}

			return $components;
		} else {
			return false;
		}
	}

	/*  Get Hardware Components by Sub Category
			@param hwcomponent_id - Id of the main component
	*/
	public function getHardwareComponentsBySubCategory($hwcomponent_id)
	{
		global $con;

		$qry = "SELECT * FROM hardwarecomponent_tbl WHERE hwcomponent_category = '" . $hwcomponent_id . "' ";

		if ($con->query($qry)) {

			$result1 = $con->query($qry);
			if ($result1->num_rows == 0) {
				return $result1->num_rows;
			}

			$components = array();

			while ($row = $result1->fetch_assoc()) {
				$components[] = $row;
			}

			return $components;
		} else {
			return false;
		}
	}

	/* Add Hardware Component */
	public function addHardwareComponent($hwcomponent_name, $hwcomponent_type, $hwcomponent_category)
	{
		global $con;

		$msg = "Please try again!";

		$qry = $con->prepare("INSERT INTO hardwarecomponent_tbl (hwcomponent_name,hwcomponent_type,hwcomponent_category) VALUES (?,?,?)");
		$qry->bind_param('sss', $hwcomponent_name, $hwcomponent_type, $hwcomponent_category);
		if ($qry->execute()) {
			$msg = "Hardware Component Added!";
		}
		return $msg;
	}

	/* Update Hardware Component */
	public function updateHardwareComponent($hwcomponent_id, $hwcomponent_name, $hwcomponent_type, $hwcomponent_category)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE hardwarecomponent_tbl SET hwcomponent_name = '" . $hwcomponent_name . "', hwcomponent_type = '" . $hwcomponent_type . "', hwcomponent_category = '" . $hwcomponent_category . "' WHERE hwcomponent_id = '" . $hwcomponent_id . "'";
		if ($con->query($qry)) {
			$msg = " Hardware Component Updated!";
		}
		return $msg;
	}



	/**  USER ACCOUNTS  **/

	/* Get User Account */
	public function getUserAccount($useraccount_id = null)
	{
		global $con;

		if ($useraccount_id == null) {

			$qry = "SELECT * FROM useraccount_tbl LEFT JOIN employee_tbl ON useraccount_tbl.emp_id=employee_tbl.emp_id LEFT JOIN department_tbl ON useraccount_tbl.dept_id=department_tbl.dept_id";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				if ($result->num_rows != 0) {
					$users = array();
					while ($row = $result->fetch_assoc()) {
						$users[] = $row;
					}
					return $users;
				} else {
					return $result->num_rows;
				}
			} else {
				return false;
			}
		} else {
			$qry = "SELECT * FROM useraccount_tbl LEFT JOIN employee_tbl ON useraccount_tbl.emp_id=employee_tbl.emp_id LEFT JOIN department_tbl ON useraccount_tbl.dept_id=department_tbl.dept_id WHERE useraccount_tbl.useraccount_id = '" . $useraccount_id . "' ";
			$result = $con->query($qry);

			return $result ? $result->fetch_assoc() : false;
		}
	}

	/* Add Department User Account */
	public function addDepartmentUserAccount($usertype, $dept_id, $username, $password)
	{
		global $con;

		$msg = "Please try again!";
		$status = 1;
		$enc_password = md5($password);

		$qry = $con->prepare("INSERT INTO useraccount_tbl (usertype,dept_id,username,password,status) VALUES (?,?,?,?,?)");
		$qry->bind_param('sissi', $usertype, $dept_id, $username, $enc_password, $status);
		if ($qry->execute()) {
			$msg = "User Account Created!\n Username: {$username}\n Password: {$password}";
		}
		return $msg;
	}

	// public function accountExists($username)
	// {
	// 	global $con;
	// 	$sql = "SELECT * FROM useraccount_tbl
	// 			WHERE username = " . $username . " LIMIT 1";
	// 	$result = $con->query($sql);
	// 	var_dump($result);
	// 	die;
	// }

	/* Add Personnel User Account */
	public function addPersonnelUserAccount($usertype, $emp_id, $username, $password)
	{
		global $con;

		$msg = "Please try again!";
		$status = 1;
		$enc_password = md5($password);

		$qry = $con->prepare("INSERT INTO useraccount_tbl (usertype,emp_id,username,password,status) VALUES (?,?,?,?,?)");
		$qry->bind_param('sissi', $usertype, $emp_id, $username, $enc_password, $status);
		if ($qry->execute()) {
			$msg = "User Account Created!\n Username: " . $username . "\n Password: " . $password;
		}
		return $msg;
	}

	/* Update User Account */
	public function updateUserAccount($useraccount_id, $usertype, $username, $emp_id, $dept_id)
	{
		global $con;

		$msg = "Please try again!";

		if ($usertype == 'department') {

			$qry = "UPDATE useraccount_tbl SET username = '" . $username . "', usertype = '" . $usertype . "', dept_id = '" . $dept_id . "' WHERE useraccount_id = '" . $useraccount_id . "'";
			if ($con->query($qry)) {
				$msg = "User Account Updated!";
			}
		} else {

			$qry = "UPDATE useraccount_tbl SET username = '" . $username . "', usertype = '" . $usertype . "', emp_id = '" . $emp_id . "' WHERE useraccount_id = '" . $useraccount_id . "'";
			if ($con->query($qry)) {
				$msg = "User Account Updated!";
			}
		}



		return json_encode($msg);
	}

	/*  Disable User Account Access */
	public function disableUserAccount($useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE useraccount_tbl SET status = '0' WHERE useraccount_id = '" . $useraccount_id . "' ";
		if ($con->query($qry)) {
			$msg = "User Account Disabled!";
		}
		return $msg;
	}

	/*  Enable User Account Access */
	public function enableUserAccount($useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE useraccount_tbl SET status = '1' WHERE useraccount_id = '" . $useraccount_id . "' ";
		if ($con->query($qry)) {
			$msg = "User Account Enabled!";
		}
		return $msg;
	}





	/**  REQUESTS  **/

	/* Get Incoming Requests */
	public function getRequest($itsrequest_id = null)
	{
		global $con;

		if ($itsrequest_id == null) {

			$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id  WHERE itshw_category is null OR itshw_category != 'pulled-out' AND itshw_category != 'walk-in' ORDER BY itsrequest_date DESC";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				if ($result->num_rows != 0) {
					$requests = array();
					while ($row = $result->fetch_assoc()) {
						$requests[] = $row;
					}
					return $requests;
				} else {
					return $result->num_rows;
				}
			} else {
				return false;
			}
		} else {
			$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id WHERE itsrequest_id = '" . $itsrequest_id . "' ";
			$result = $con->query($qry);
			return $result ? $result->fetch_assoc() : false;
		}
	}

	/* Get Incoming Requests by Department */
	public function getRequestByDepartment($dept_id)
	{
		global $con;

		$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id WHERE itservices_request_tbl.dept_id = '" . $dept_id . "' ORDER BY itsrequest_date DESC";
		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows != 0) {
				$requests = array();
				while ($row = $result->fetch_assoc()) {
					$requests[] = $row;
				}
				return $requests;
			} else {
				return $result->num_rows;
			}
		} else {
			return false;
		}
	}

	public function getRequestsByEmployee($emp_id)
	{
		global $con;

		$qry = "SELECT * FROM itservices_request_tbl 
				INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
		 		LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
				WHERE itservices_request_tbl.emp_id = {$emp_id} ORDER BY itsrequest_date DESC";

		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows) {
				$requests = array();
				while ($row = $result->fetch_assoc()) {
					$requests[] = $row;
				}
				return $requests;
			} else {
				return 0;
			}
		} else {
			return false;
		}
	}

	public function getTotalRequestsByDepartment($dept_id)
	{
		$requests = $this->getRequestByDepartment($dept_id);
		return is_array($requests) ? count($requests) : 0;
	}

	/* Add Incoming Request */
	public function addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category)
	{
		global $con;

		$msg = "Please try again!";

		$qry = $con->prepare("INSERT INTO itservices_request_tbl (dept_id,emp_id,itsrequest_category,hwcomponent_id,concern,itsrequest_date,itshw_category) VALUES (?,?,?,?,?,?,?)");
		$qry->bind_param('iisisss', $dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		if ($qry->execute()) {
			$msg = "Request Sent!";
		}
		return $msg;
	}

	/*  Set Request Status to Done */
	public function statusDoneRequest($itsrequest_id, $solution, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'done', solution = '" . $solution . "', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Done!";
		}
		return $msg;
	}

	/*  Set Request Status to Go */
	public function statusPendingRequest($itsrequest_id, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'pending', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Set to Pending!";
		}
		return $msg;
	}

	/*  Set Request Status to AssessmentPending */
	public function statusAssessmentPendingRequest($itsrequest_id, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'Assessment Pending', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Set to Assessment Pending!";
		}
		return $msg;
	}

	/*  Set Request Status to Assessed */
	public function statusAssessedRequest($itsrequest_id, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'Assessed', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Set to Assessed!";
		}
		return $msg;
	}

	/*  Set Request Status to Pre-repair Inspected */
	public function statusPreInspectedRequest($itsrequest_id, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'Pre-repair Inspected', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Set to Pre-repair Inspected!";
		}
		return $msg;
	}

	/*  Set Request Status to Post-repair Inspected */
	public function statusPostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'Post-repair Inspected', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Set to Post-repair Inspected!";
		}
		return $msg;
	}


	/*  Set Request Status to Deployed */
	public function statusDeployedRequest($itsrequest_id, $rec_date)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET status = 'deployed', received_date = '" . $rec_date . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Hardware of this Request is Received!";
		}
		return $msg;
	}

	/*  Set Request Hardware Category to Pulled-out */
	public function categoryPulloutRequest($itsrequest_id, $hwcomponent_id, $property_num, $statusupdate_useraccount_id)
	{
		global $con;

		$msg = "Please try again!";

		$qry = "UPDATE itservices_request_tbl SET itshw_category = 'pulled-out', hwcomponent_id = '" . $hwcomponent_id . "', property_num = '" . $property_num . "', status = 'received', statusupdate_useraccount_id = '" . $statusupdate_useraccount_id . "' WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if ($con->query($qry)) {
			$msg = "Request Categorized as Pulled Out!";
		}
		return $msg;
	}

	public function getSubComponentsAssessmentByMainAssessmentId($repassessreport_id)
	{
		global $con;

		$sql = "SELECT * FROM assessment_sub_components
						WHERE repassessreport_id = {$repassessreport_id}";
		$result = $con->query($sql);
		$subComponentsAssessmentReports = [];
		while ($row = $result->fetch_assoc()) {
			$subComponentsAssessmentReports[] = $row;
		}
		return $subComponentsAssessmentReports;
	}


	/**   REPAIRS   **/


	/* Get Repairs */
	public function getRepair($itsrequest_id = null)
	{
		global $con;

		if ($itsrequest_id == null) {
			$qry = "SELECT * FROM itservices_request_tbl 
							INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id 
							INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id 
							INNER JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id 
							WHERE itshw_category != 'on-site' AND itshw_category is NOT NULL 
							ORDER BY itsrequest_date DESC";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				$requests = array();
				while ($row = $result->fetch_assoc()) {
					$requests[] = $row;
				}
				return $requests;
			} else {
				return false;
			}
		} else {

			$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id WHERE itsrequest_id = '" . $itsrequest_id . "' ";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				if ($result->num_rows == 1) {
					$requests = array();
					while ($row = $result->fetch_assoc()) {
						$requests[] = $row;
					}
					return $requests;
				} else {
					return $result->num_rows;
				}
			} else {
				return false;
			}
		}
	}

	/* Get Incoming Repair by Department */
	public function getRepairByDepartment($dept_id)
	{
		global $con;

		$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id WHERE itshw_category != 'on-site' AND itshw_category is NOT NULL AND itservices_request_tbl.dept_id = '" . $dept_id . "' ORDER BY itsrequest_date DESC";
		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows != 0) {
				$requests = array();
				while ($row = $result->fetch_assoc()) {
					$requests[] = $row;
				}
				return $requests;
			} else {
				return $result->num_rows;
			}
		} else {
			return false;
		}
	}

	/* Get Incoming Repair by Date */
	public function getRepairByDate($itsrequest_date)
	{
		global $con;

		$qry = "SELECT * FROM itservices_request_tbl INNER JOIN employee_tbl ON itservices_request_tbl.emp_id=employee_tbl.emp_id INNER JOIN department_tbl ON itservices_request_tbl.dept_id=department_tbl.dept_id LEFT JOIN hardwarecomponent_tbl ON itservices_request_tbl.hwcomponent_id=hardwarecomponent_tbl.hwcomponent_id WHERE itshw_category != 'on-site' AND itshw_category is NOT NULL AND itservices_request_tbl.itsrequest_date = '" . $itsrequest_date . "' ORDER BY itsrequest_date DESC";
		if ($con->query($qry)) {
			$result = $con->query($qry);
			if ($result->num_rows != 0) {
				$requests = array();
				while ($row = $result->fetch_assoc()) {
					$requests[] = $row;
				}
				return $requests;
			} else {
				return $result->num_rows;
			}
		} else {
			return false;
		}
	}


	/* Add Repairs */
	public function addRepair($dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_subcategory, $property_num, $concern, $statusupdate_useraccount_id, $req_date)
	{
		global $con;

		$msg = "Please try again!";

		$qry = $con->prepare("INSERT INTO itservices_request_tbl (dept_id,emp_id,itsrequest_category,itshw_category,hwcomponent_id,hwcomponent_sub_id,property_num,concern,statusupdate_useraccount_id,itsrequest_date) VALUES (?,?,?,?,?,?,?,?,?,?)");
		$qry->bind_param('iissiissis', $dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_subcategory, $property_num, $concern, $statusupdate_useraccount_id, $req_date);
		if ($qry->execute()) {
			$msg = "Repair Added";
		}
		return $msg;
	}





	/**   ASSESSMENT REPORTS   **/

	/* Insert Assessment report data to db */
	public function addRepAssessReport(
		$itsrequest_id,
		$hwcomponent_id,
		$assessmenttechrep_useraccount_id,
		$assessment_date,
		$hwcomponent_dateAcquired,
		$hwcomponent_description,
		$hwcomponent_acquisitioncost,
		$serial_number,
		$findings_category,
		$findings_description,
		$notes,
		$dept_id,
		$emp_id,
		$property_num
	) {
		global $con;

		$assessmentReportId = null;
		$sql = "INSERT INTO repassessreport_tbl  
								(itsrequest_id, 
								hwcomponent_id,
								assessmenttechrep_useraccount_id,
								assessment_date, 
								hwcomponent_dateAcquired,
								hwcomponent_description, 
								serial_number, 
								hwcomponent_acquisitioncost, 
								findings_category,
								findings_description,
								notes) 
								VALUES (
									'" . $itsrequest_id . "',
									'" . $hwcomponent_id . "',
									'" . $assessmenttechrep_useraccount_id . "',
									'" . $assessment_date . "',
									'" . $hwcomponent_dateAcquired . "',
									'" . $hwcomponent_description . "',
									'" . $serial_number . "',
									'" . $hwcomponent_acquisitioncost . "',
									'" . $findings_category . "',
									'" . $findings_description . "',
									'" . $notes . "'
								)";
		// (recommendation) <-- missing column
		$isInserted = $con->query($sql);
		if (!$isInserted) {
			return false;
		}
		$assessmentReportId = $con->insert_id;
		$qry = "UPDATE itservices_request_tbl 
						 SET dept_id = '" . $dept_id . "', 
						 emp_id = '" . $emp_id . "', 
						 statusupdate_useraccount_id = '" . $assessmenttechrep_useraccount_id . "', 
						 hwcomponent_id = '" . $hwcomponent_id . "', 
						 property_num = '" . $property_num . "', 
						 status = 'assessed' 
						 WHERE itsrequest_id = '" . $itsrequest_id . "' ";
		if (!$con->query($qry)) {
			return false;
		}

		return $assessmentReportId;
	}

	/** Insert subcomponents assessment report to db */
	public function addAssessmentSubComponents($repassessreport_id, $subcomponents)
	{
		global $con;

		foreach ($subcomponents as $subcomponent) {
			$sql = "INSERT INTO assessment_sub_components (repassessreport_id, sub_component_id, remark)
							VALUES (?,?,?)";

			$stmt = $con->prepare($sql);
			$stmt->bind_param('iis', $repassessreport_id, $subcomponent['sub_component_id'], $subcomponent['remark']);
			if (!$stmt->execute()) {
				return false;
			}
		}

		return true;
	}

	/* Get Assess Reports */
	public function getAssessmentReport($id)
	{
		global $con;
		$sql = "SELECT * FROM repassessreport_tbl
						WHERE repassessreport_id = {$id}
						LIMIT 1";

		$result = $con->query($sql);
		return $result->fetch_assoc();
	}

	public function getAssessmentReportByRequestId($itsrequest_id = null)
	{
		global $con;

		if ($itsrequest_id == null) {
			$qry = "SELECT * FROM repassessreport_tbl ORDER BY assessment_date";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				if ($result->num_rows != 0) {
					$reports = array();
					while ($row = $result->fetch_assoc()) {
						$reports[] = $row;
					}
					return $reports;
				} else {
					return $result->num_rows;
				}
			} else {
				return false;
			}
		} else {

			$qry = "SELECT * FROM repassessreport_tbl WHERE itsrequest_id = {$itsrequest_id} ";
			if ($con->query($qry)) {
				$result = $con->query($qry);
				if ($result->num_rows != 0) {
					return $result->fetch_assoc();
				} else {
					return $result->num_rows;
				}
			} else {
				return false;
			}
		}
	}


	public function dd($any)
	{
		echo "<pre style='background-color: #eee; color:#fff;'>";
		var_dump($any);
		echo	"</pre>";
		die;
	}
}
