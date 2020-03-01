<?php

use App\Request;
use App\Repair;
use App\Employee;
use App\Hardware;
use App\Assessment;

require_once('../init.php');

if (isset($_POST['action'])) {
	/**   GET REQUEST  **/
	if ($_POST['action'] === 'getRequest') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$result = Request::getRequest($itsrequest_id);
		echo json_encode($result);
	}

	if ($_POST['action'] === 'getAllRequests') {
		$requests = Request::getRequest();
		echo json_encode($requests);
	}

	if ($_POST['action'] == 'getRequestsByEmployee') {
		$emp_id = $_POST['emp_id'];
		$requests = Request::getRequestsByEmployee($emp_id);
		echo json_encode($result);
	}



	/**   GET REPAIR  **/


	if ($_POST['action'] === 'getRepair') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$result = Repair::getRepair($itsrequest_id);
		echo json_encode($result);
	}



	/**   GET EMPLOYEE BY DEPARTMENT  **/

	if ($_POST['action'] === 'getEmployeesByDepartment') {
		$dept_id = $_POST['dept_id'];
		$result = Employee::getEmployeesByDepartment($dept_id);
		echo json_encode($result);
	}



	/**   GET SUBCOMPONENTS   **/


	if ($_POST['action'] === 'getHardwareComponentsBySubCategory') {
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$result = Hardware::getHardwareComponentsBySubCategory($hwcomponent_id);
		echo json_encode($result);
	}


	/**  SET REQUEST STATUS  **/


	if ($_POST['action'] === 'statusDone') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$solution = $_POST['solution'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];
		$deployment_date = date('M d, Y');
		$result = Request::statusDoneRequest($itsrequest_id, $solution, $statusupdate_useraccount_id, $deployment_date);
		echo $result;
	}

	if ($_POST['action'] === 'statusPending') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$result = Request::statusPendingRequest($itsrequest_id, $statusupdate_useraccount_id);
		echo $result;
	}

	if ($_POST['action'] === 'statusDeployed') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$rec_date = date('Y-m-d H:i:s');

		$result = Request::statusDeployedRequest($itsrequest_id, $rec_date);

		echo $result;
	}

	if ($_POST['action'] === 'statusAssessmentPending') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = Request::statusAssessmentPendingRequest($itsrequest_id, $statusupdate_useraccount_id);
		echo $result;
	}

	if ($_POST['action'] === 'statusAssessed') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = Request::statusAssessedRequest($itsrequest_id, $statusupdate_useraccount_id);
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
		$request = Request::getRequest($itsrequest_id);
		$dept_id = $request->dept_id;
		$emp_id = $request->emp_id;
		$property_num = $request->property_num;

		$result = Assessment::addRepAssessReport(
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

		$result = Assessment::addAssessmentSubComponents($assessmentReportId, $subcomponents);
		echo $result;
	}

	if ($_POST['action'] === 'addInspectionReport') {
		echo 'good';
	}

	if ($_POST['action'] === 'statusPreInspected') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = Request::statusPreInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusPostInspected') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = Request::statusPostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	if ($_POST['action'] === 'statusPreAndPostInspected') {
		$itsrequest_id = $_POST['itsrequest_id'];
		$statusupdate_useraccount_id = $_POST['useraccount_id'];

		$result = Request::statusPrePostInspectedRequest($itsrequest_id, $statusupdate_useraccount_id);

		echo $result;
	}

	/**  SET REQUEST CATEGORY  **/


	if ($_POST['action'] === 'categoryPulloutRequest') {

		$itsrequest_id = $_POST['itsrequest_id'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$property_num = $_POST['property_num'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];

		$result = Request::categoryPulloutRequest($itsrequest_id, $hwcomponent_id, $property_num, $statusupdate_useraccount_id);

		echo $result;
	}


	/**   ADD REPAIR  **/


	if ($_POST['action'] === 'addWalk-inRepair') {
		$dept_id = $_POST['dept_id'];
		$emp_id = $_POST['emp_id'];
		$itsrequest_category = $_POST['itsrequest_category'];
		$itshw_category = $_POST['itshw_category'];
		$hwcomponent_id = $_POST['hwcomponent_id'];
		$hwcomponent_sub_id = $_POST['hwcomponent_subcategory'];
		$property_num = $_POST['property_num'];
		$concern = $_POST['concern'];
		$statusupdate_useraccount_id = $_POST['statusupdate_useraccount_id'];
		$itsrequest_date = date('Y-m-d H:i:s');

		$result = Repair::addRepair($dept_id, $emp_id, $itsrequest_category, $itshw_category, $hwcomponent_id, $hwcomponent_sub_id, $property_num, $concern, $statusupdate_useraccount_id, $itsrequest_date);

		echo $result;
	}




	/**   ADD REQUEST  **/


	if ($_POST['action'] === 'addRequest') {
		$dept_id = $_POST['dept_id'];
		$emp_id = $_POST['emp_id'];
		$itsrequest_category = $_POST['itsrequest_category'];
		$hwcomponent_id = $_POST['hwcomponent_id'] ?? null;
		$concern = $_POST['concern'];
		$req_date = date('Y-m-d H:i:s');

		if ($itsrequest_category === 'hw') {
			$itshw_category = "on-site";
			$result = Request::addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		} else {
			$itshw_category = "";
			$hwcomponent_id = null;
			$hwcomponent_subcategory = null;
			$result = Request::addRequest($dept_id, $emp_id, $itsrequest_category, $hwcomponent_id, $concern, $req_date, $itshw_category);
		}

		echo $result;
	}
}
