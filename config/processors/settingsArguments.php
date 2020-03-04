<?php

use App\User;
use App\Employee;
use App\Hardware;
use App\Department; 

require_once('../init.php');

if (isset($_POST['action'])) {

	/**   ADD SETTINGS  **/
	if ($_POST['action'] === 'addDepartmentUserAccount') {

		$usertype = $_POST['usertype'];
		$dept_id = $_POST['dept_id'];
		$username = $_POST['username'];
		$resultword = $_POST['password'];

		$result = User::addDepartmentUserAccount($usertype, $dept_id, $username, $resultword);
		echo $result;
	}

	if ($_POST['action'] === 'addPersonnelUserAccount') {

		$usertype = $_POST['usertype'];
		$emp_id = $_POST['emp_id'];
		$username = $_POST['username'];
		$resultword = $_POST['password'];

		$result = User::addPersonnelUserAccount($usertype, $emp_id, $username, $resultword);
		echo $result;
	}

	if ($_POST['action'] === 'addEmployee') {
		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];
		$emp_position = $_POST['position'];

		$result = Employee::create($dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position);
		echo $result;
	}

	if ($_POST['action'] === 'addDepartment') {
		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$result = Department::addDepartment($dept_code, $dept_name);
		echo $result;
	}

	if ($_POST['action'] === 'addHardwareComponent') {
		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];

		$hwcomponent_category = $_POST['hwcomponent_category'];

		$result = Hardware::addHardwareComponent($hwcomponent_name, $hwcomponent_type, $hwcomponent_category);
		echo $result;
	}


	/**   GET SETTINGS  **/


	if ($_POST['action'] === 'editDepartment') {
		$dept_id = $_POST['dept_id'];
		$result = Department::getDepartment($dept_id);
		echo json_encode($result);
	}

	if ($_POST['action'] === 'editHardwareComponent') {
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$result = Hardware::getHardwareComponents($hwcomponent_id); 
		echo json_encode($result);
	}

	if ($_POST['action'] === 'editEmployee') {
		$emp_id = $_POST['emp_id'];
		$result = Employee::getEmployee($emp_id);
		echo json_encode($result);
	}

	if ($_POST['action'] === 'editUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$result = User::getUserAccount($useraccount_id);
		echo json_encode($result);
	}



	/**   UPDATE SETTINGS  **/

	if ($_POST['action'] === 'updateDepartment') {
		$dept_id = $_POST['dept_id'];
		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$result = Department::updateDepartment($dept_id, $dept_code, $dept_name);
		echo $result;
	}

	if ($_POST['action'] === 'updateHardwareComponent') {
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];
		$hwcomponent_category = $hwcomponent_type === 'main' ? NULL : $_POST['hwcomponent_category'];

		$result = Hardware::updateHardwareComponent($hwcomponent_id, $hwcomponent_name, $hwcomponent_type, $hwcomponent_category);
		echo $result;
	}

	if ($_POST['action'] === 'updateEmployee') {
		$emp_id = $_POST['emp_id'];
		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];
		$emp_position = $_POST['position'];

		$result = Employee::updateEmployee($emp_id, $dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position);
		echo $result;
	}

	if ($_POST['action'] === 'updateUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$usertype = $_POST['usertype'];
		$username = $_POST['username'];

		if ($usertype == 'department') {
			$dept_id = $_POST['dept_id'];
			$emp_id = null;
		} else {
			$emp_id = $_POST['emp_id'];
			$dept_id = "";
		}

		$result = User::updateUserAccount($useraccount_id, $usertype, $username, $emp_id, $dept_id);
		echo $result;
	}


	/**   OTHER SETTINGS ACTIONS  **/


	if ($_POST['action'] === 'disableUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$result = User::disableUserAccount($useraccount_id);
		echo $result;
	}

	if ($_POST['action'] === 'enableUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$result = User::enableUserAccount($useraccount_id);
		echo $result;
	}
}
