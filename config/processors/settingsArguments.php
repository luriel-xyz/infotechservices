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
		$password = $_POST['password'];

		$pass = User::addDepartmentUserAccount($usertype, $dept_id, $username, $password);
		echo $pass;
	}

	if ($_POST['action'] === 'addPersonnelUserAccount') {

		$usertype = $_POST['usertype'];
		$emp_id = $_POST['emp_id'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$pass = User::addPersonnelUserAccount($usertype, $emp_id, $username, $password);
		echo $pass;
	}

	if ($_POST['action'] === 'addEmployee') {
		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];
		$emp_position = $_POST['position'];

		$pass = Employee::create($dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position);
		echo $pass;
	}

	if ($_POST['action'] === 'addDepartment') {
		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$pass = Department::addDepartment($dept_code, $dept_name);
		echo $pass;
	}

	if ($_POST['action'] === 'addHardwareComponent') {
		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];

		$hwcomponent_category === 'main' ? NULL : $_POST['hwcomponent_category'];

		$pass = Hardware::addHardwareComponent($hwcomponent_name, $hwcomponent_type, $hwcomponent_category);
		echo $pass;
	}


	/**   GET SETTINGS  **/


	if ($_POST['action'] === 'editDepartment') {
		$dept_id = $_POST['dept_id'];
		$pass = Department::getDepartment($dept_id);
		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editHardwareComponent') {
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$pass = Hardware::getHardwareComponents($hwcomponent_id); 
		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editEmployee') {
		$emp_id = $_POST['emp_id'];
		$pass = Employee::getEmployee($emp_id);
		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$pass = User::getUserAccount($useraccount_id);
		echo json_encode($pass);
	}



	/**   UPDATE SETTINGS  **/

	if ($_POST['action'] === 'updateDepartment') {
		$dept_id = $_POST['dept_id'];
		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$pass = Department::updateDepartment($dept_id, $dept_code, $dept_name);
		echo $pass;
	}

	if ($_POST['action'] === 'updateHardwareComponent') {
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];
		$hwcomponent_category = $hwcomponent_type === 'main' ? NULL : $_POST['hwcomponent_category'];

		$pass = Hardware::updateHardwareComponent($hwcomponent_id, $hwcomponent_name, $hwcomponent_type, $hwcomponent_category);
		echo $pass;
	}

	if ($_POST['action'] === 'updateEmployee') {
		$emp_id = $_POST['emp_id'];
		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];
		$emp_position = $_POST['position'];

		$pass = Employee::updateEmployee($emp_id, $dept_id, $emp_idnum, $emp_fname, $emp_lname, $emp_position);
		echo $pass;
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

		$pass = User::updateUserAccount($useraccount_id, $usertype, $username, $emp_id, $dept_id);
		echo $pass;
	}


	/**   OTHER SETTINGS ACTIONS  **/


	if ($_POST['action'] === 'disableUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$pass = User::disableUserAccount($useraccount_id);
		echo $pass;
	}

	if ($_POST['action'] === 'enableUserAccount') {
		$useraccount_id = $_POST['useraccount_id'];
		$pass = User::enableUserAccount($useraccount_id);
		echo $pass;
	}
}
