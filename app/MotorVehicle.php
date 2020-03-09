<?php

namespace App;

use App\DB;

class MotorVehicle
{
  /**
   * Create a motor vehicle.
   * @return int lastInsertId()
   */
  public static function create(
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
    $defects_complaints
  ) {
    $sql = 'INSERT INTO motor_vehicles 
            (inspection_report_id, type, plate_no, property_no, engine_no, chassis_no, acquisition_date, acquisition_cost, repair_history, repair_date, nature_of_last_repair, defects_complaints)
            VALUES 
            (:inspection_report_id, :type, :plate_no, :property_no, :engine_no, :chassis_no, :acquisition_date, :acquisition_cost, :repair_history, :repair_date, :nature_of_last_repair, :defects_complaints)';

    return DB::insert($sql, [
      ':inspection_report_id' => $inspection_report_id,
      ':type' => $type,
      ':plate_no' => $plate_no,
      ':property_no' => $property_no,
      ':engine_no' => $engine_no,
      ':chassis_no' => $chassis_no,
      ':acquisition_date' => $acquisition_date,
      ':acquisition_cost' => $acquisition_cost,
      ':repair_history' => $repair_history,
      ':repair_date' => $repair_date,
      ':nature_of_last_repair' => $nature_of_last_repair,
      ':defects_complaints' => $defects_complaints
    ]);
  }

  public static function byInspectionReportId($id)
  {
    $sql = 'SELECT * FROM motor_vehicles
            WHERE inspection_report_id = ?
            LIMIT 1';

    return DB::single($sql, [$id]);
  }
}
