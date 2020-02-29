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
      if ($requests) :
        foreach ($requests as $request) :
          if ($request->statusupdate_useraccount_id) {
            $technician = User::getUserAccount($request->statusupdate_useraccount_id);
            $tech_name = $technician->emp_fname . ' ' . $technician->emp_lname;
          } else {
            $tech_name = "";
          }
      ?>
          <tr>
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