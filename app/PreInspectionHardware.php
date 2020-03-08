<?php

namespace App;

use App\DB;

class PreInspectionHardware
{
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
}
