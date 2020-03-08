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
    $date_inspected
  ) {
    $sql = 'INSERT INTO pre_inspections
            (inspection_report_id, repair_inspection, job_order, additional_sheet, inspected_by, recommending_approval, approved, date_inspected)
            VALUES 
            (:inspection_report_id, :repair_inspection, :job_order, :additional_sheet, :inspected_by, :recommending_approval, :approved, :date_inspected)';
    
    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':repair_inspection' => $repair_inspection,
      ':job_order' => $job_order,
      ':additional_sheet' => $additional_sheet,
      ':inspected_by' => $inspected_by,
      ':recommending_approval' => $recommending_approval,
      ':approved' => $approved,
      ':date_inspected' => $date_inspected
    ]);
  }

  public static function byInspectionReportId($id) {
    $sql = 'SELECT * FROM pre_inspections
            WHERE inspection_report_id = ?
            LIMIT 1';

    return DB::single($sql, [$id]);
  }
}
