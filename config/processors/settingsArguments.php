<?php

//include database connection
require_once('../db_connection.php');

//include file containing queries
include_once "../controllers/controller.php";

//instantiate Controller
$control = new Controller();

if (isset($_POST['action'])) {


	/**   ADD SETTINGS  **/


	if ($_POST['action'] === 'addDepartmentUserAccount') {

		$usertype = $_POST['usertype'];
		$dept_id = $_POST['dept_id'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$pass = $control->addDepartmentUserAccount($usertype, $dept_id, $username, $password);

		echo $pass;
	}

	if ($_POST['action'] === 'addPersonnelUserAccount') {

		$usertype = $_POST['usertype'];
		$emp_id = $_POST['emp_id'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$pass = $control->addPersonnelUserAccount($usertype, $emp_id, $username, $password);

		echo $pass;
	}

	if ($_POST['action'] === 'addEmployee') {

		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];

		$pass = $control->addEmployee($dept_id, $emp_idnum, $emp_fname, $emp_lname);

		echo $pass;
	}

	if ($_POST['action'] === 'addDepartment') {

		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$pass = $control->addDepartment($dept_code, $dept_name);

		echo $pass;
	}

	if ($_POST['action'] === 'addHardwareComponent') {

		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];

		if ($hwcomponent_type === 'main') {
			$hwcomponent_category = NULL;
		} else {
			$hwcomponent_category = $_POST['hwcomponent_category'];
		}

		$pass = $control->addHardwareComponent($hwcomponent_name, $hwcomponent_type, $hwcomponent_category);

		echo $pass;
	}


	/**   GET SETTINGS  **/


	if ($_POST['action'] === 'editDepartment') {

		$dept_id = $_POST['dept_id'];

		$pass = $control->getDepartment($dept_id);

		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editHardwareComponent') {

		$hwcomponent_id = $_POST['hwcomponent_id'];

		$pass = $control->getHardwareComponents($hwcomponent_id);

		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editEmployee') {

		$emp_id = $_POST['emp_id'];

		$pass = $control->getEmployee($emp_id);

		echo json_encode($pass);
	}

	if ($_POST['action'] === 'editUserAccount') {

		$useraccount_id = $_POST['useraccount_id'];

		$pass = $control->getUserAccount($useraccount_id);

		echo json_encode($pass);
	}



	/**   UPDATE SETTINGS  **/

	if ($_POST['action'] === 'updateDepartment') {

		$dept_id = $_POST['dept_id'];
		$dept_code = $_POST['dept_code'];
		$dept_name = $_POST['dept_name'];

		$pass = $control->updateDepartment($dept_id, $dept_code, $dept_name);

		echo $pass;
	}

	if ($_POST['action'] === 'updateHardwareComponent') {

		$hwcomponent_id = $_POST['hwcomponent_id'];
		$hwcomponent_name = $_POST['hwcomponent_name'];
		$hwcomponent_type = $_POST['hwcomponent_type'];

		if ($hwcomponent_type === 'main') {
			$hwcomponent_category = NULL;
		} else {
			$hwcomponent_category = $_POST['hwcomponent_category'];
		}

		$pass = $control->updateHardwareComponent($hwcomponent_id, $hwcomponent_name, $hwcomponent_type, $hwcomponent_category);

		echo $pass;
	}

	if ($_POST['action'] === 'updateEmployee') {

		$emp_id = $_POST['emp_id'];
		$dept_id = $_POST['dept_id'];
		$emp_idnum = $_POST['emp_idnum'];
		$emp_fname = $_POST['fname'];
		$emp_lname = $_POST['lname'];

		$pass = $control->updateEmployee($emp_id, $dept_id, $emp_idnum, $emp_fname, $emp_lname);

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

		$pass = $control->updateUserAccount($useraccount_id, $usertype, $username, $emp_id, $dept_id);

		echo $pass;
	}


	/**   OTHER SETTINGS ACTIONS  **/


	if ($_POST['action'] === 'disableUserAccount') {

		$useraccount_id = $_POST['useraccount_id'];

		$pass = $control->disableUserAccount($useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'enableUserAccount') {

		$useraccount_id = $_POST['useraccount_id'];

		$pass = $control->enableUserAccount($useraccount_id);

		echo $pass;
	}
}
