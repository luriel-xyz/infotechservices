<?php

namespace App;

use App\DB;

class PreInspectionReport
{

  /**
   * Create a pre inspection report.
   * @return int lastInsertId()
   */
  public static function create(
    $inspection_report_id,
    $repair_inspection,
    $job_order,
    $additional_sheet,
    $inspected_by,
    $recommending_approval,
    $approved,
    $inspected_date
  ) {
    $sql = 'INSERT INTO pre_inspections
            (inspection_report_id, repair_inspection, job_order, additional_sheet, inspected_by, recommending_approval, approved, inspected_date)
            VALUES 
            (:inspection_report_id, :repair_inspection, :job_order, :additional_sheet, :inspected_by, :recommending_approval, :approved, :inspected_date)';
    
    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':repair_inspection' => $repair_inspection,
      ':job_order' => $job_order,
      ':additional_sheet' => $additional_sheet,
      ':inspected_by' => $inspected_by,
      ':recommending_approval' => $recommending_approval,
      ':approved' => $approved,
      ':inspected_date' => $inspected_date
    ]);
  }
}
