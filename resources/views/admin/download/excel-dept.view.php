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
      if ($result) :
        foreach ($result as $data) :
          if ($data->statusupdate_useraccount_id) {
            $technician = App\User::find($data->statusupdate_useraccount_id);
            $tech_name = "{$technician->emp_fname} {$technician->emp_lname}";
          } else {
            $tech_name = "";
          }
      ?>
          <tr>
            <td><?= $data->itsrequest_date ?></td>
            <td><?= $data->emp_fname ?> <?= $data->emp_lname ?></td>
            <td><?= $data->hwcomponent_name ?></td>
            <?php
            if ($action === 'RepairSummaryReport') {
              echo '<td>' . $data->property_num . '</td>';
            }
            ?>
            <td><?= $data->concern ?></td>
            <td><?= $data->status ?></td>
            <td><?= $tech_name ?></td>
            <td><?= $data->solution ?></td>
            <?php
            if ($action === 'RepairSummaryReport') {
              echo '<td>' . $data->deployment_date . '</td>';
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