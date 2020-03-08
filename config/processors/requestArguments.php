<?php

use App\Auth;
use App\Request;
use App\Repair;
use App\Employee;
use App\Hardware;
use App\Assessment;
use App\InspectionReport;
use App\MotorVehicle;

require_once('../init.php');

if (isset($_POST['action'])) {

	/** AUTH */
	if ($_POST['action'] === 'attemptLogin') {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = Auth::login($username, $password);
		echo json_encode($user);
	}

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

	if ($_POST['action'] == 'fetchRequestConcern') {
		$requestId = $_POST['requestId'];
		$request = Request::getRequest($requestId)->concern;
		echo json_encode($request);
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

	/** ASSESSMENT REPORT */

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
			$notes
		);

		Assessment::setAssessmentDone($dept_id, $emp_id, $assessmenttechrep_useraccount_id, $hwcomponent_id, $property_num, $itsrequest_id);

		echo $result;
	}

	if ($_POST['action'] === 'addAssessmentSubComponents') {
		$assessmentReportId = $_POST['assessmentReportId'];
		$subcomponents = $_POST['subcomponents'];

		if (empty($subcomponents)) {
			$result = true;
		} else {
			$result = Assessment::addAssessmentSubComponents($assessmentReportId, $subcomponents);
		}
		echo $result;
	}

	/** INSPECTION REPORT */

	if ($_POST['action'] === 'addInspectionReport') {
		$to_whom = $_POST['to_whom'];
		$control_no = $_POST['control_no'];
		$date = $_POST['date'];

		$result = InspectionReport::create($to_whom, $control_no, $date);
		echo json_encode($result);
	}

	if ($_POST['action'] === 'addMotorVehicle') {
		$inspection_report_id = $_POST['inspection_report_id'];
		$type = $_POST['type'];
		$plate_no = $_POST['plate_no'];
		$property_no = $_POST['property_no'];
		$engine_no = $_POST['engine_no'];
		$chassis_no = $_POST['chassis_no'];
		$acquisition_date = $_POST['acquisition_date'];
		$acquisition_cost = $_POST['acquisition_cost'];
		$repair_history = $_POST['repair_history'];
		$repair_date = $_POST['repair_date'];
		$nature_of_last_repair = $_POST['nature_of_last_repair'];
		$defects_complaints = $_POST['defects_complaints'];

		$result = MotorVehicle::create(
			$inspection_report_id,
			$type,
			$plate_no,
			$property_no,
			$engine_no,
			$chassis_no,
			$acquisition_date,
			$acquisition_cost,
			$repair_history,
			$repair_date,
			$nature_of_last_repair,
			$defects_complaints,
		);

		echo json_encode($result);
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
