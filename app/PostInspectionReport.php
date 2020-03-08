<?php

namespace App;

use App\DB;

class PostInspectionReport
{

  /**
   * Create a post inspection report.
   * @return int lastInsertId()
   */
  public static function create(
    $inspection_report_id,
    $inspected_by,
    $recommending_approval,
    $approved,
    $repair_inspection,
    $stock,
    $with_wm_prs,
    $ics_no,
    $inventory_item_no,
    $serial_no,
    $date_inspected
  ) {
    $sql = 'INSERT INTO post_inspections
            (inspection_report_id, 
             inspected_by, 
             recommending_approval, 
             approved, 
             repair_inspection, 
             stock, 
             with_wm_prs, 
             ics_no, 
             inventory_item_no, 
             serial_no, 
             date_inspected)
            VALUES
            (:inspection_report_id, 
             :inspected_by, 
             :recommending_approval, 
             :approved, 
             :repair_inspection, 
             :stock, 
             :with_wm_prs, 
             :ics_no, 
             :inventory_item_no, 
             :serial_no, 
             :date_inspected)';

    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':inspected_by' => $inspected_by,
      ':recommending_approval' => $recommending_approval,
      ':approved' => $approved,
      ':repair_inspection' => $repair_inspection,
      ':stock' => $stock,
      ':with_wm_prs' => $with_wm_prs,
      ':ics_no' => $ics_no,
      ':inventory_item_no' => $inventory_item_no,
      ':serial_no' => $serial_no,
      ':date_inspected' => $date_inspected
    ]);
  }

  public static function byInspectionReportId($id) {
    $sql = 'SELECT * FROM post_inspections
            WHERE inspection_report_id = ?
            LIMIT 1';

    return DB::single($sql, [$id]);
  }
}
