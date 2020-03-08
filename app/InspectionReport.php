<?php

namespace App;

use App\DB;

class InspectionReport
{

  /**
   * Create an inspection report.
   * @param string $to_whom
   * @param string $control_no
   * @param string $date
   * @return int lastInsertId()
   */
  public static function create(string $to_whom, string $control_no, $date) : int
  {
    $sql = 'INSERT INTO inspection_reports (to_whom, control_no, date)
            VALUES (:to_whom, :control_no, :date)';

    return DB::insert($sql, [
      ':to_whom' => $to_whom,
      ':control_no' => $control_no,
      ':date' => $date
    ]);
  }
}
