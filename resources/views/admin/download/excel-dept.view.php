<html>

<head>
  <title></title>
  <style>
    th {
      background-color: gray;
    }

    h3 {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=" . date('m_d_Y') . $action . ".xls");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private", false);
  ?>

  <table border='1' border-color='#333'>
    <thead>
      <h3>
        <?php
        if ($action === 'RepairSummaryReport') {
          echo $dept_code . ' REPAIR ';
        } else if ($action === 'RequestSummaryReport') {
          echo $dept_code . ' REQUEST ';
        }
        echo 'SUMMARY REPORT as of ' . date('M d Y');
        ?>
      </h3>
    </thead>
    <thead>
      <th>Request Date</th>
      <th>Employee</th>
      <th>Hardware</th>
      <?php
      if ($action === 'RepairSummaryReport') {
        echo '<th>Property Number</th>';
      }
      ?>
      <th>Concern</th>
      <th>Status</th>
      <th>IT Personnel</th>
      <th>Solution</th>
      <?php
      if ($action === 'RepairSummaryReport') {
        echo '<th>Deployment Date</th>';
      }
      ?>
    </thead>
    <tbody>
      <?php
      if ($requests) :
        foreach ($requests as $request) :
          if ($request->statusupdate_useraccount_id) {
            $technician = $control->getUserAccount($request->statusupdate_useraccount_id);
            $tech_name = "{$technician->emp_fname} {$technician->emp_lname}";
          } else {
            $tech_name = "";
          }
      ?>
          <tr>
            <td><?= $request->itsrequest_date ?></td>
            <td><?= $request->emp_fname ?> <?= $request->emp_lname ?></td>
            <td><?= $request->hwcomponent_name ?></td>
            <?php
            if ($action === 'RepairSummaryReport') {
              echo '<td>' . $request->property_num . '</td>';
            }
            ?>
            <td><?= $request->concern ?></td>
            <td><?= $request->status ?></td>
            <td><?= $tech_name ?></td>
            <td><?= $request->solution ?></td>
            <?php
            if ($action === 'RepairSummaryReport') {
              echo '<td>' . $request->received_date . '</td>';
            }
            ?>
          </tr>
      <?php
        endforeach;
      endif;
      ?>
    </tbody>
  </table>

</body>

</html>