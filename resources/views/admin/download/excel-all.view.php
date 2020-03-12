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
          echo 'REPAIR ';
        } else if ($action === 'RequestSummaryReport') {
          echo 'REQUEST ';
        } else {
          echo 'SUMMARY REPORT as of ' . date('M d Y');
        }
        ?>
      </h3>
    </thead>
    <thead>
      <th>Request Date</th>
      <th>Department/Office</th>
      <th>Employee</th>
      <th>Hardware</th>
      <?php if ($action === 'RepairSummaryReport') : ?>
        <th>Property Number</th>
      <?php endif; ?>
      <th>Concern</th>
      <th>Status</th>
      <th>IT Personnel</th>
      <th>Solution</th>
      <?php if ($action === 'RepairSummaryReport') : ?>
        <th>Deployment Date</th>
      <?php endif; ?>
    </thead>
    <tbody>
      <?php
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
          <td><?= $data->dept_name ?></td>
          <td><?= $data->emp_fname ?> <?= $data->emp_lname ?></td>
          <td><?= $data->hwcomponent_name ?? 'N/A' ?></td>
          <?php if ($action === 'RepairSummaryReport') : ?>
            <td><?= $data->property_num ?></td>
          <?php endif ?>
          <td><?= $data->concern ?></td>
          <td><?= $data->status ?></td>
          <td><?= $tech_name ?? 'n/a' ?></td>
          <td><?= $data->solution ?></td>
          <?php if ($action === 'RepairSummaryReport') : ?>
            <td><?= $data->deployment_date ?></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>

</html>