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
    $other_type,
    $model,
    $other_property_number,
    $serial_number,
    $other_acquisition_date,
    $other_acquisition_cost,
    $issued_to,
    $requested_by
  ) {
    $sql = 'INSERT INTO others 
            (inspection_report_id, other_type, model, other_property_number, serial_number, other_acquisition_date, other_acquisition_cost, issued_to, requested_by)
            VALUES 
            (:inspection_report_id, :other_type, :model, :other_property_number, :serial_number, :other_acquisition_date, :other_acquisition_cost, :issued_to, :requested_by)';

    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':other_type' => $other_type,
      ':model' => $model,
      ':other_property_number' => $other_property_number,
      ':serial_number' => $serial_number,
      ':other_acquisition_date' => $other_acquisition_date,
      ':other_acquisition_cost' => $other_acquisition_cost,
      ':issued_to' => $issued_to,
      ':requested_by' => $requested_by
    ]);
  }
}
