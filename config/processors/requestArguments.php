<?php

//include database connection
require_once('../db_connection.php');

//include file containing queries
include_once "../controllers/controller.php";

//instantiate Controller
$control = new Controller();


if (isset($_POST['action'])) {


	/**   GET REQUEST  **/


	if ($_POST['action'] === 'getRequest') {

		$itsrequest_id = $_POST['itsrequest_id'];

		$pass = $control->getRequest($itsrequest_id);

		echo json_encode($pass);
	}

	if ($_POST['action'] == 'getRequestsByEmployee') {

		$emp_id = $_POST['emp_id'];
		$requests = $control->getRequestsByEmployee($emp_id);
		echo json_encode($pass);
	}



	/**   GET REPAIR  **/


	if ($_POST['action'] === 'getRepair') {

		$itsrequest_id = $_POST['itsrequest_id'];

		$pass = $control->getRepair($itsrequest_id);

		echo json_encode($pass);
	}



	/**   GET EMPLOYEE BY DEPARTMENT  **/


	if ($_POST['action'] === 'getEmployeesByDepartment') {

		$dept_id = $_POST['dept_id'];

		$pass = $control->getEmployeesByDepartment($dept_id);

		echo json_encode($pass);
	}



	/**   GET SUBCOMPONENTS   **/


	if ($_POST['action'] === 'getHardwareComponentsBySubCategory') {

		$hwcomponent_id = $_POST['hwcomponent_id'];

		$pass = $control->getHardwareComponentsBySubCategory($hwcomponent_id);

		echo json_encode($pass);
	}


	/**  SET REQUEST STATUS  **/


	if ($_POST['action'] === 'statusDone') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$solution = $_POST['solution'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$pass = $control->statusDoneRequest($itsrequest_id, $solution, $statusupdate_useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'statusPending') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$pass = $control->statusPendingRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'statusDeployed') {

		$itsrequest_id = $_POST['itsrequest_id'];
		date_default_timezone_set('Asia/Manila');
		$rec_date = date('Y-m-d H:i:s');

		$pass = $control->statusDeployedRequest($itsrequest_id, $rec_date);

		echo $pass;
	}

	if ($_POST['action'] === 'statusAssessmentPending') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$pass = $control->statusAssessmentPendingRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'statusAssessed') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$pass = $control->statusAssessedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'statusPreInspected') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$pass = $control->statusPreInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $pass;
	}

	if ($_POST['action'] === 'statusPostInspected') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$pass = $control->statusPostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $pass;
	}



	/**  SET REQUEST CATEGORY  **/


	if ($_POST['action'] === 'categoryPulloutRequest') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$property_num = $_POST['property_num'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$pass = $control->categoryPulloutRequest($itsrequest_id, $hwcomponent_id, $property_num, $statusupdate_useraccount_id);

		echo $pass;
	}


	/**   ADD REPAIR  **/


	if ($_POST['action'] === 'addWalk-inRepair') {

		$dept_id = $_POST['dept_id'];
		$emp_id = $_POST['emp_id'];
		$itsrequest_category = $_POST['itsrequest_category'];
		$itshw_category = $_POST['itshw_category'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$hwcomponent_subcategory = $_POST['hwcomponent_subcategory'];
		$property_num = $_POST['property_num'];
		$concern = $_POST['concern'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];
		date_default_timezone_set('Asia/Manila');
		$req_date = date('Y-m-d H:i:s');

		$pass = $control->addRepair($dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_subcategory, $property_num, $concern, $statusupdate_useraccount_id, $req_date);

		echo $pass;
	}




	/**   ADD REQUEST  **/


	if ($_POST['action'] === 'addRequest') {

		$dept_id = $_POST['dept_id'];
		$emp_id = $_POST['emp_id'];
		$itsrequest_category = $_POST['itsrequest_category'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$concern = $_POST['concern'];
		date_default_timezone_set('Asia/Manila');
		$req_date = date('Y-m-d H:i:s');

		if ($itsrequest_category === 'hw') {
			$itshw_category = "on-site";
			$pass = $control->addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		} else {
			$itshw_category = "";
			$hwcomponent_id = null;
			$hwcomponent_subcategory = null;
			$pass = $control->addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		}

		echo $pass;
	}
}
