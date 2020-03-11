<html>

<head>
  <title></title>
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
      <center>
        <h3>
          <?php
          if ($action === 'RepairSummaryReport') {
            echo $day . ' REPAIR ';
          } else if ($action === 'RequestSummaryReport') {
            echo $day . ' REQUEST ';
          }
          echo 'SUMMARY REPORT as of ' . date('M d Y');
          ?>
        </h3>
      </center>
    </thead>
    <thead>
      <th style="background-color: gray">Employee</th>
      <th style="background-color: gray">Hardware</th>
      <?php
      if ($action === 'RepairSummaryReport') {
        echo '<th style="background-color: gray">Property Number</th>';
      }
      ?>
      <th style="background-color: gray">Concern</th>
      <th style="background-color: gray">Status</th>
      <th style="background-color: gray">IT Personnel</th>
      <th style="background-color: gray">Solution</th>
      <?php
      if ($action === 'RepairSummaryReport') {
        echo '<th style="background-color: gray">Deployment Date</th>';
      }
      ?>
    </thead>
    <tbody>
      <?php
      if ($result) :
        foreach ($result as $data) :
          if ($data->statusupdate_useraccount_id) {
            $technician = App\User::find($data->statusupdate_useraccount_id);
            $tech_name = $technician->emp_fname . ' ' . $technician->emp_lname;
          } else {
            $tech_name = "";
          }
      ?>
          <tr>
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
              echo '<td>' . $data->received_date . '</td>';
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