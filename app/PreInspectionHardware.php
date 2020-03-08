<?php

namespace App;

use App\DB;

class PreInspectionHardware
{

  /**
   * Create a pre inspection hardware.
   * @return int lastInsertId()
   */
  public function create($pre_inspection_id, $qty, $unit, $description, $amount)
  {
    $sql = 'INSERT INTO pre_inspection_parts 
            (pre_inspection_id, qty, unit, description, amount)
            VALUES 
            (:pre_inspection_id, :qty, :unit, :description, :amount)';

    return DB::insert($sql, [
      ':pre_inspection_id' => $pre_inspection_id,
      ':qty' => $qty,
      ':unit' => $unit,
      ':description' => $description,
      ':amount' => $amount
    ]);
  }

  public static function allByPreInspectionReportId($id) {
    $sql = 'SELECT * FROM pre_inspection_parts
            WHERE pre_inspection_id = ?
            LIMIT 1';

    return DB::all($sql, [$id]);
  }
}
