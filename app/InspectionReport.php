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
  public static function create($assessment_report_id, string $to_whom, string $control_no, $date): int
  {
    $sql = 'INSERT INTO inspection_reports (assessment_report_id, to_whom, control_no, date)
            VALUES (:assessment_report_id, :to_whom, :control_no, :date)';

    return DB::insert($sql, [
      ':assessment_report_id' => $assessment_report_id,
      ':to_whom' => $to_whom,
      ':control_no' => $control_no,
      ':date' => $date
    ]);
  }

  public static function byAssessmentReportId($id)
  {
    $sql = 'SELECT * FROM inspection_reports
            WHERE assessment_report_id = ?
            LIMIT 1';

    return DB::single($sql, [$id]);
  }
}
