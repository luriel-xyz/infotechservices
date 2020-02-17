<!--  InfoTechServices System
      Programmer: 
        Dalmo, Manilyn
-->

<!--  repair form adding page  -->

<?php 
date_default_timezone_set("Asia/Manila");
//start session
session_start();

//check if user is not logged in
if(!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])){

  //redirect to login page
  header ('location: ../login.php');

}else{
	if($_SESSION['usertype'] !== 'admin' && $_SESSION['usertype'] !== 'personnel' && $_SESSION['usertype'] !== 'programmer'){
		//redirect to login page
  		header ('location: ../login.php');
	}
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

//get all departments
$departments = $control->getDepartment();

//get all hardware component
$hardwarecomponents = $control->getHardwareComponentsByCategory('main');

?>	

<!DOCTYPE html>

<html class="h-100 w-100">

<head>

    <!-- Meta Tag to Set Page's Width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Title Page  -->
    <title>Pre-Repair Inspection Report</title>

    <!--  Link Bootstrap stylesheet -->
    <link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
  	<script src="../plug-ins/jquery/jquery.min.js"></script>
  	<script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

  	<!-- Jquery Redirect JavaScript -->
  	<script src="../plug-ins/jquery/jquery.redirect.js"></script>

</head>

<body class="h-1000 w-1000 bg-dark">
  
  	<!-- Page Content -->
    <div class="h-1000 w-1000 row">

      	<!--  Container -->
      	<div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12  my-auto text-white">

	        <form method="POST" class=" p-3 border rounded" id="incomingrepair-form">

	          <div class="form-group text-center">

	            <p class="h3"><i class="fa fa-wrench" aria-hidden="true"></i> Pre-Repair Inspection Report</p>

	            <?php
						$query = $con->query("SELECT * FROM `itservices_request_tbl` NATURAL JOIN `hardwarecomponent_tbl`") or die(mysqli_error());
						$fetch = $query->fetch_array();
						
					?>

	          </div>
	          <div class="form-group col-md-6">
	          <div class="form-row">
				<input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair">
			  </div>

			  <div class="form-row">
				<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?php echo $_SESSION['useraccount_id']; ?>">
			  </div>

			  <div>
			  	<input type="hidden" class="form-control" name="itshw_category" id="itshw_category" value="walk-in">
			  </div>
			  </div>
			  <div class="form-col">
	          <h5 class="card-title">PGO - IT FILE</h5>
	          <div class="form-row">
	          	<div class="form-group col-md-6">
	          	
    				<div class="form-row">
    				<h6 class="card-title">TO:
		            <input type="text" class="form-control"  name="" id="" value="" disabled>
		            </h6>
		            </div>
		            <div class="form-row">
		            <h6 class="card-title">Control No:
	            	<input type="text" class="form-control"  name="" id="" value="" disabled>
	            	</h6>
	            	</div>
	            	<div class="form-row">
	            	<h6 class="card-title">Date
		            <input type="date" class="form-control"  name="" id="" value="" disabled>
		            </h6>
		            </div>
    				
    			</div>
    			</div>
    			</div>
				<hr class="border border-light">
    			<h5 class="card-title">DESCRIPTION OF PROPERTY, PLANT AND EQUIPMENT</h5>
    			
	          <div class="form-col">
			  <div class="container-fluid row">
			  	<div class="col-lg-12">
			  		<h5 class="card-title">A. Motor Vehicles</h5>
			  		</div>
	          <div class="col-lg-2">
	          	
	          	<label class="form-group col-lg-12"> Type: </label>
	          	<br><br>
	          	<label class="form-group col-lg-12""> Plate Number: </label>
	            <br><br>
	            <label class="form-group col-lg-12" > Property Number: </label>
	            <br><br>
	            <label class="form-group col-lg-12" > Engine Number: </label>
	            <br><br>
	             <label class="form-group col-lg-12" > Chassis Number: </label>
				<br><br>
	            <label class="form-group col-lg-12" > Acquisition Date: </label>
	            <br><br>
	            <label class="form-group col-lg-12" > Acquisition Cost: </label>
	            <br><br>
	            <label class="form-group col-lg-12" > Repair History and Date: </label>
	            <br>
	            <label class="form-group col-lg-12" > Nature of Last Repair and Maintenance: </label>
	            <br><br>
	            <label class="form-group col-lg-12" > Defects/Complaints: </label>

	          </div>

	          <div class="col-lg-4 form-group">
	          	
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	<input type="text" class="form-control"  name="" id="" value="" ><br>
	          	</div>

	          <div class="form-group col-md-6">
	          	<h5 class="card-title">B. Other Property, Plant and Equipment</h5>
	          	<h6 class="card-title">Type:
	            <input type="text" class="form-control"  name="" id="" value="" >
	            </h6>
	          
	          	<h6 class="card-title">Model:
	            <input type="text" class="form-control"  name="" id="" value="" >
	            </h6>
	            <h6 class="card-title">Property Number:
	            <input type="text" class="form-control"  name="" id="" value="" >
	            </h6>
	            <h6 class="card-title">Serial Number:
	            <input type="text" class="form-control"  name="" id="" value="">
	            </h6>
	            <h6 class="card-title">Acquisition Date:
	            <input type="date" class="form-control"  name="" id="" value="">
	            </h6>
	            <h6 class="card-title">Acquisition Cost:
	            <input type="text" class="form-control"  name="" id="" value="">
	            </h6>
	            <h6 class="card-title">Issued to:
	            <input type="text" class="form-control"  name="" id="" value="">
	            </h6>
	            <h6 class="card-title">Requested by:
	            		<input type="text" class="form-control"  name="" id="" value="">
	            	</h6>
	          </div>

	          </div>
	          
	          <div class="form-row">

	          	<div class="form-group col-md-6">
	          	</div>
	          	<div class="form-row">
	          		
	          	</div>
	          </div>
	          </div>
	  			<hr>


	  			

	  				<h5 class="card-title">PRE-REPAIR INSPECTION</h5>


			  <div class="form-row">

	          <div class="form-group col-md-6">
	          	<h6 class="card-title">I. Findings/Recommendations:
	            <input type="text" class="form-control"  name="" id="" value="" >
	            </h6>
	          
	          	<h6 class="card-title">II. Job Order:
	            <input type="text" class="form-control"  name="" id="" value="" >
	            </h6>

	            <h6 class="card-title">III. Parts to be Replaced and/or Procured:
	            </h6>
	            </div>
	            </div>

	            <div class="form-col">
			  <div class="form-row">
			  	<center>
	            <table class="table " style="text-align: center;">
	            	<thead>
	           
	            	<tr>
				        <th><center><p6 class="card-title" style="color: white;">Qty</p6></center></th>
				        <th><center><p6 class="card-title" style="color: white;">Unit</p6></center></th>
				        <th><center><p6 class="card-title" style="color: white;">Particulars/Description</p6></center></th>
				        <th><center><p6 class="card-title" style="color: white;">Amount</p6></center></th>

				      </tr>
	            	
	            	
	            	</thead>
	            <tbody>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      <tr>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			        <td><input type="text" class="form-control"  name="" id="" value="" ></td>
			      </tr>
			      </tbody>

				</table>
				</center>

				</div>

				</div>
	  				
	  					<hr> 
	  					<div class="form-group">
	          		<input type="checkbox" name="" id="" value=""> 
				        <p5 class="card-title">Additional Sheet Attached</p5>
				    </div>

	  					<div class="form-col">
	  				<div class="form-row">

					<div class="form-group col-md-3">

						
						<h5 class="card-title">Pre-Inspected by:</h5><br>
						<center>
						<h4 class="card-title"><u>Rae Sandy B. Calado</u></h4>
						<h6 class="card-title">Technical Property Inspector</h6>
						</center>
						<h6 class="card-title">Date:</h6>
						<td><input type="date" class="form-control"  name="" id="" value="" ></td>
	          		</div>
	          		<div class="form-group col-md-5">
						<h5 class="card-title">Recommending Approval:</h5><br>
						<center>
						<h4 class="card-title"><u>Florita T. Bay-on</u></h4>
						<h6 class="card-title">Provincial General Services Officer<h6><br>
						<h4 class="card-title"><u>Brian A. Camhit</u></h4>
						<h6 class="card-title">Acting Provincial Administrator<h6>
						</center>
					</div>
					<div class="form-group col-md-4">
						<h5 class="card-title">Approved:</h5><br>
						<center>
						<h4 class="card-title"><u>Melchor D. Diclas</u></h4>
						<h6 class="card-title">Provincial Governor</h6>
						</center>

	          		</div>
	          		
	          		</div>
	          		</div>

	          <div class="form-row">
	            <div class="col text-center">

	              <button type="submit" class="btn btn-secondary" id="submit-btn">Submit</button>
	      
	            </div>
	          </div>

	        </form>

      </div>
      <!--/# Container -->

	</div>
	<!-- /# Page Content -->

</body>

</html>

<script type="text/javascript">

$(document).ready(function(){

    $('#request_category').show();
    $('#hw_category').show();
    $('#itsrequest_category').val('hw');

	$('#dept_id').change(function(){
    var action = 'getEmployeesByDepartment';
    var dept_id = $(this).val();
      $.ajax({
        url: "../config/processors/requestArguments.php",
        type: "POST",
        data: { action:action, dept_id:dept_id},
      }).done(function(employees){   
        employees = JSON.parse(employees);
        $('#emp_id').empty();
        $('#emp_id').append('<option value = "">'+ '-- Select Employee --' +'</option>');
        employees.forEach(function(employee){
        	$('#emp_id').append('<option value = '+ employee.emp_id +'>'+ employee.emp_fname + ' ' + employee.emp_lname +'</option>')
     	 });
      });        
    });

	$('#hwcomponent_id').change(function(){
    var action = 'getHardwareComponentsBySubCategory';
    var hwcomponent_id = $(this).val();

      $.ajax({
        url: "../config/processors/requestArguments.php",
        type: "POST",
        data: { action:action, hwcomponent_id:hwcomponent_id},
      }).done(function(components){  

        components = JSON.parse(components);
        $('#hwcomponent_subcategory').empty();
        $('#hwcomponent_subcategory').append('<option value = "">'+ '-- Select Specific Hardware Component(Optional) --' +'</option>');
        components.forEach(function(components){
        	$('#hwcomponent_subcategory').append('<option value = '+ components.hwcomponent_id +'>'+ components.hwcomponent_name +'</option>')
     	 });
      });        
    });

    $('#incomingrepair-form').submit(function(e){
	 	e.preventDefault();

	 	$.ajax({
          	url: "../config/processors/requestArguments.php",
          	type: "POST",
          	data: $(this).serialize(),
        }).done(function(val){
        	alert(val);
        	window.close();
        });

	});

});
	
</script>