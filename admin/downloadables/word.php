<?php
if(isset($_POST['itsrequest_id'])){

  $itsrequest_id = $_POST['itsrequest_id'];

}

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

//get hardware components
$components = $control->getHardwareComponentsByCategory('main');

//get request details
$request = $control->getRequest($itsrequest_id);

//get assessment details
$assessment = $control->getAssessmentReport($itsrequest_id);

foreach ($request as $key => $value) {
  $dept_code = $value['dept_code'];
  $emp_lname = $value['emp_lname'];
  $emp_fname = $value['emp_fname'];
  $hwcomponent_name = $value['hwcomponent_name'];
  $property_num = $value['property_num'];
}

foreach ($assessment as $key => $value) {
  $assessment_date = $value['assessment_date'];
  $date_acquired = $value['hwcomponent_dateacquired'];
  $hwcomponent_description = $value['hwcomponent_description'];
  $acquisition_cost = $value['hwcomponent_acquisitioncost'];
  $serial_num = $value['serial_number'];
  $findings_category = $value['findings_category'];
  $notes = $value['notes'];
  $findings_description = $value['findings_description'];
  $hwcomponent_sub_id = $value['hwcomponent_sub_id'];
}

?>
<html>
<head>
	<title></title>
</head>
<body>
<?php

header("Content-type:application/msword");
header("Content-Disposition:attachment;filename="."repassessment".$dept_code."-".$emp_lname.".docx");

echo '<center>';
echo '<h3>PROVINCE OF BENGUET</h3>';
echo '<h2>INFORMATION TECHNOLOGY SERVICES</h2>';
echo "<h4>PROVINCIAL GOVERNOR'S OFFICE</h4>";
echo "<p>REPAIR ASSESSMENT REPORT</p>";
echo "<br>";
?>

<table>
  <tr>
    <td> Date: </td>
    <td> <?php echo $assessment_date; ?> </td>
    <td> Department/Office: </td>
    <td> <?php echo $dept_code; ?> </td>
  </tr>
  <tr>
    <td> Name of Item: </td>
    <td> <?php echo $hwcomponent_name; ?> </td>
    <td> Property No.: </td>
    <td> <?php echo $property_num; ?> </td>
  </tr>
  <tr>
    <td> Date Acquired: </td>
    <td> <?php echo $date_acquired; ?> </td>
    <td> Issued To: </td>
    <td> <?php echo $emp_fname." ".$emp_lname; ?> </td>
  </tr>
  <tr>
    <td> Model/Description: </td>
    <td> <?php echo $hwcomponent_description; ?> </td>
    <td> Serial No.: </td>
    <td> <?php echo $serial_num; ?> </td>
  </tr>
  <tr>
    <td> </td>
    <td> </td>
    <td> Acquisition Cost: </td>
    <td> <?php echo $acquisition_cost; ?> </td>
  </tr>
</table>

<table class="table table-bordered text-center">
  <p>PROBLEMS:</p>
  <tbody>
    <?php
    foreach ($components as $key => $value) {
    ?> 
    <tr>
    <th><?=$value['hwcomponent_name']?></th> 
    <td>
      <ul>
        <?php
        $subcomponents = $control->getHardwareComponentsBySubCategory($value['hwcomponent_id']);
        if($subcomponents !== 0){
          foreach ($subcomponents as $key => $val) {
          ?>
          <li> <?php echo $val['hwcomponent_name']; ?> </li>
        <?php
          }  
        }
        ?>
      </ul>
    </td>
    </tr>
    <?php
    }  
    ?>
  </tbody>
</table>

<?php
echo '</center>';;
?>

</body>
</html>