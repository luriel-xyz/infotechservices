<?php

namespace App;

use App\DB;

class OtherPropPlantEquip
{
  /**
   * Create an 'other property plant & equipment data'.
   * @return int lastInsertId()
   */
  public static function create(
    $inspection_report_id,
    $type,
    $model,
    $property_no,
    $serial_no,
    $acquisition_date,
    $acquisition_cost,
    $issued_to,
    $requested_by
  ) {
    $sql = 'INSERT INTO others 
            (inspection_report_id, type, model, property_no, serial_no, acquisition_date, acquisition_cost, issued_to, requested_by)
            VALUES 
            (:inspection_report_id, :type, :model, :property_no, :serial_no, :acquisition_date, :acquisition_cost, :issued_to, :requested_by)';

    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':type' => $type,
      ':model' => $model,
      ':property_no' => $property_no,
      ':serial_no' => $serial_no,
      ':acquisition_date' => $acquisition_date,
      ':acquisition_cost' => $acquisition_cost,
      ':issued_to' => $issued_to,
      ':requested_by' => $requested_by
    ]);
  }
}
