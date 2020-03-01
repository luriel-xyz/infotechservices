<?php

namespace App;

use App\DB;

class Assessment
{
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
									:itsrequest_id,
									:hwcomponent_id,
									:assessmenttechrep_useraccount_id,
									:assessment_date,
									:hwcomponent_dateAcquired,
									:hwcomponent_description,
									:serial_number,
									:hwcomponent_acquisitioncost,
									:findings_category,
									:findings_description,
                  :notes)";

    $assessmentReportId = DB::insert($sql, [
      ':itsrequest_id' => $itsrequest_id,
      ':hwcomponent_id' => $hwcomponent_id,
      ':assessmenttechrep_useraccount_id' => $assessmenttechrep_useraccount_id,
      ':assessment_date' => $assessment_date, 
      ':hwcomponent_dateAcquired' => $hwcomponent_dateAcquired,
      ':hwcomponent_description' => $hwcomponent_description,
      ':serial_number' => $serial_number,
      ':hwcomponent_acquisitioncost' => $hwcomponent_acquisitioncost,
      ':findings_category' => $findings_category,
      ':findings_description' => $findings_description,
      ':notes' => $notes
    ]);

    if (!$assessmentReportId) {
      return false;
    }

    $success = self::setAssessmentDone($dept_id, $emp_id, $assessmenttechrep_useraccount_id, $hwcomponent_id, $property_num, $itsrequest_id);
    if (!$success) {
      return false;
    }


    return $assessmentReportId;
  }

  /** Insert subcomponents assessment report data to db */
  public function addAssessmentSubComponents($repassessreport_id, $subcomponents)
  {
    foreach ($subcomponents as $subcomponent) {
      $sql = "INSERT INTO assessment_sub_components 
              (repassessreport_id, sub_component_id, remark)
							VALUES (:repassessreport_id,:sub_component_id,:remark)";

      $data = [
        ':repassessreport_id' => $repassessreport_id,
        ':sub_component_id' => $subcomponent['sub_component_id'],
        ':remark' => $subcomponent['remark']
      ];

      if (!DB::insert($sql, $data)) {
        return false;
      }
    }

    return true;
  }

  /* Get Assess Reports */
  public function getAssessmentReport($id)
  {
    $sql = "SELECT * FROM repassessreport_tbl
						WHERE repassessreport_id = ?
						LIMIT 1";

    return DB::single($sql, [$id]);
  }

  public function getAssessmentReportByRequestId($itsrequest_id = null)
  {
    if ($itsrequest_id == null) {
      $sql = "SELECT * FROM repassessreport_tbl ORDER BY assessment_date";
      return DB::all($sql);
    } else {
      $sql = "SELECT * FROM repassessreport_tbl WHERE itsrequest_id = ?";
      return DB::single($sql, [$itsrequest_id]);
    }
  }

  public function getSubComponentsAssessmentByMainAssessmentId($repassessreport_id)
  {
    $sql = "SELECT * FROM assessment_sub_components
						WHERE repassessreport_id = ?";
    return DB::all($sql, [$repassessreport_id]);
  }

  public static function setAssessmentDone($dept_id, $emp_id, $assessmenttechrep_useraccount_id, $hwcomponent_id, $property_num, $itsrequest_id)
  {
    $sql = "UPDATE itservices_request_tbl 
						 SET dept_id = :dept_id, 
						 emp_id = :emp_id, 
						 statusupdate_useraccount_id = :statusupdate_useraccount_id, 
						 hwcomponent_id = :hwcomponent_id, 
						 property_num = :property_num, 
						 status = :status 
             WHERE itsrequest_id = :itsrequest_id";

    $isInserted = DB::insert($sql, [
      ':dept_id' => $dept_id,
      ':emp_id' => $emp_id,
      ':statusupdate_useraccount_id' => $assessmenttechrep_useraccount_id,
      ':hwcomponent_id' => $hwcomponent_id,
      ':property_num' => $property_num,
      ':status' => 'assessed',
      ':itsrequest_id' => $itsrequest_id
    ]);

    return $isInserted;
  }
}
