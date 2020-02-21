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

		$result = $control->getRequest($itsrequest_id);

		echo json_encode($result);
	}

	if ($_POST['action'] == 'getRequestsByEmployee') {

		$emp_id = $_POST['emp_id'];
		$requests = $control->getRequestsByEmployee($emp_id);
		echo json_encode($result);
	}



	/**   GET REPAIR  **/


	if ($_POST['action'] === 'getRepair') {

		$itsrequest_id = $_POST['itsrequest_id'];

		$result = $control->getRepair($itsrequest_id);

		echo json_encode($result);
	}



	/**   GET EMPLOYEE BY DEPARTMENT  **/


	if ($_POST['action'] === 'getEmployeesByDepartment') {

		$dept_id = $_POST['dept_id'];

		$result = $control->getEmployeesByDepartment($dept_id);

		echo json_encode($result);
	}



	/**   GET SUBCOMPONENTS   **/


	if ($_POST['action'] === 'getHardwareComponentsBySubCategory') {

		$hwcomponent_id = $_POST['hwcomponent_id'];

		$result = $control->getHardwareComponentsBySubCategory($hwcomponent_id);

		echo json_encode($result);
	}


	/**  SET REQUEST STATUS  **/


	if ($_POST['action'] === 'statusDone') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$solution = $_POST['solution'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];
		$deployment_date = date('M d, Y');

		$result = $control->statusDoneRequest($itsrequest_id, $solution, $statusupdate_useraccount_id, $deployment_date);

		echo $result;
	}

	if ($_POST['action'] === 'statusPending') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$result = $control->statusPendingRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusDeployed') {

		$itsrequest_id = $_POST['itsrequest_id'];
		date_default_timezone_set('Asia/Manila');
		$rec_date = date('Y-m-d H:i:s');

		$result = $control->statusDeployedRequest($itsrequest_id, $rec_date);

		echo $result;
	}

	if ($_POST['action'] === 'statusAssessmentPending') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = $control->statusAssessmentPendingRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusAssessed') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = $control->statusAssessedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'addRepAssessReport') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$assessmenttechrep_useraccount_id = $_POST['assessmenttechrep_useraccount_id'];
		$assessment_date = $_POST['assessment_date'];
		$hwcomponent_dateAcquired = $_POST['hwcomponent_dateAcquired'];
		$hwcomponent_description = $_POST['hwcomponent_description'];
		$serial_number = $_POST['serial_number'];
		$hwcomponent_acquisitioncost = $_POST['hwcomponent_acquisitioncost'];
		$findings_category = $_POST['findings_category'];
		$findings_description = $_POST['findings_description'];
		$notes = $_POST['notes'];

		// Get request
		$request = $control->getRequest($itsrequest_id);
		$dept_id = $request['dept_id'];
		$emp_id = $request['emp_id'];
		$property_num = $request['property_num'];

		$result = $control->addRepAssessReport( 
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
		);

		echo $result;
	}

	if ($_POST['action'] === 'addAssessmentSubComponents') {
		$assessmentReportId = $_POST['assessmentReportId'];
		$subcomponents = $_POST['subcomponents'];

		$result = $control->addAssessmentSubComponents($assessmentReportId, $subcomponents);
		echo $result;
	}

	if ($_POST['action'] === 'addInspectionReport') {
		echo 'good';
	}

	if ($_POST['action'] === 'statusPreInspected') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = $control->statusPreInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusPostInspected') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = $control->statusPostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusPreAndPostInspected') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = $control->statusPrePostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	/**  SET REQUEST CATEGORY  **/


	if ($_POST['action'] === 'categoryPulloutRequest') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$property_num = $_POST['property_num'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$result = $control->categoryPulloutRequest($itsrequest_id, $hwcomponent_id, $property_num, $statusupdate_useraccount_id);

		echo $result;
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

		$result = $control->addRepair($dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_subcategory, $property_num, $concern, $statusupdate_useraccount_id, $req_date);

		echo $result;
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
			$result = $control->addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		} else {
			$itshw_category = "";
			$hwcomponent_id = null;
			$hwcomponent_subcategory = null;
			$result = $control->addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		}

		echo $result;
	}
}
