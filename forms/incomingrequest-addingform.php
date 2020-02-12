<!--  InfoTechServices System
      Programmer: 
        Dalmo, Manilyn
-->

<!--  request form page  -->

<?php 

//start session
session_start();

//check if user is not logged in
if(!isset($_SESSION["username"]) && !isset($_SESSION["useraccount_id"])) {
  //redirect to login page
  header ('location: ../login.php');
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

$employees = $control->getEmployeesByDepartment($_SESSION['dept_id']);

$mainHardwareComponents = $control->getHardwareComponentsByCategory('main');

?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>

    <!-- Meta Tag to Set Page's Width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Title Page  -->
    <title>PGO IT Services - Client Page</title>

    <!--  Link Bootstrap stylesheet -->
    <link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
  	<script src="../plug-ins/jquery/jquery.min.js"></script>
  	<script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

  	<!-- Jquery Redirect JavaScript -->
  	<script src="../plug-ins/jquery/jquery.redirect.js"></script>

</head>

<body class="h-100 w-100 bg-dark">
  
  	<!-- Page Content -->
    <div class="h-100 w-100 row">

      	<!--  Container -->
      	<div class="container-fluid col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3 my-auto text-success">

	        <form method="POST" class=" p-3 border border-success rounded" id="incomingrequest-form">

	          <div class="form-group text-center">

	            <p class="h3">IT Service Request Form</p>

	          </div>

	          <div class="form-group">
				<input type="hidden" class="form-control" name="action" id="action" value="addRequest">
			  </div>

			  <div class="form-group">
				<input type="hidden" class="form-control" name="dept_id" id="dept_id" value="<?=$_SESSION['dept_id']?>">
			  </div>

	          <div class="form-group">

	            <select class="form-control" id="emp_id" name="emp_id">
	              <option>-- Select Your Name --</option>
	              <?php foreach ($employees as $value) : ?>
	                <option value="<?=$value['emp_id']?>"> <?=$value['emp_fname']?> <?=$value['emp_lname']?> </option>
	              <?php endforeach; ?>
	            </select>

	          </div>

	          <div class="form-group">

	            <select class="form-control" id="itsrequest_category" name="itsrequest_category">

	              <option value=""> -- Select Request Type -- </option>
	              <option value="hw"> Hardware </option>
	              <option value="other"> Other </option>

	            </select>

	          </div>

	          <div id="hw_category" style="display: none;">

	          	<div class="form-group" >
	            
		            <select class="form-control" id="hwcomponent_id" name="hwcomponent_id">

		              <option value=""> -- Select Particular Hardware -- </option>
		              
		              <?php
		              foreach ($mainHardwareComponents as $key => $value) {
		              ?>
		                <option value="<?=$value['hwcomponent_id']?>"> <?=$value['hwcomponent_name']?> </option>
		              <?php
		              }
		              ?>

		            </select>

	        	</div>

	          </div>

	          <div class="form-group">
	          	<label for="concern">Concerns:</label>
	            <textarea class="form-control" id="concern" name="concern" placeholder="(e.g) CPU - Restarts on its own"></textarea>

	          </div>
	  
	          <div class="row">
	            <div class="col text-center">

	              <button type="submit" class="btn btn-success">Request</button>
	              <button type="reset" onclick="window.close()" class="btn btn-danger">Cancel</button>
	      
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

	$('#itsrequest_category').change(function(e){
		e.preventDefault();
   		var itsrequest_category = $(this).val();

    	if(itsrequest_category === 'hw'){
    		$('#hw_category').show();
    	}else{
    		$('#hw_category').hide();
    	}
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

    $('#incomingrequest-form').submit(function(e){
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