<!DOCTYPE html>
<html lang = "en">	
	<?php
		session_start();
	?>
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<style>
			#operation_buttons
			{
				
				width: 30%;
				margin-left: 20%;
				display: inline-block;
			}
			
			#changeSuccessNot
			{
				width:60%;
				text-align: center;
				margin-left: 20%;
			}
		</style>
	</head>
	
	<body>
		<p id="date" style = "text-align: right; margin-right: 300px; font-size : 110%;"></p>
		<h1 style = "text-align: center;" id = "gg">
			Account Settings
		</h1>
	
<!---->	<div id = "account_ui" style = " margin-left: 20%;">
			<p class = "lead" id="employee_name" style = "text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="position" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="office" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
		</div>
		
<!---->	<div id = "operation_buttons">
			<button type="button"  onclick="location.href='Client_Menu.php';" class="btn btn-primary" id = "menuB" onclick = "initializeModalAdd();">Back</button>
		</div>		
		<div><p><br></p></div>
		
<!---->	<div  style =  "text-align: center;">
			<div class="alert alert-success" style = "display:none" id = "changeSuccessNot" ></div>
		</div>		
		
<!---->	<div id = "d" style =  "text-align: center;">
			<h2 style = "text-align: center;" id = "F">
				Operations
			</h2><br>
			
			<button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-warning btn-lg" id = "menuB">Change Password</button>
			
		</div>		
		
<!--Modal-CHANGE PASSWORD-->
		<div id = "modal-Operations" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id = "content">
					<div class="modal-header">
						<h3 class="modal-title" id="ModalLabel" style = "display: inline-block;">Password Change</h3>
						<button type="button" class="close " data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
<!--Enter data here--><div class="modal-body" id = "table_view_body">	
						
						<div id = "Account">
							<div style = "text-align: center;">
								<h2>Account Info</h2>
							</div>
							<div>
								<p id = "modal_Name" style="font-weight:bold">Name:</p>
								<p id = "modal_Username" style="font-weight:bold">Username:</p>
							</div>
						</div>
						<div id = "cp1">
						<label for="oldPas">Enter Old Password:</label>
						<input type="password" class="form-control" id="oldPas" placeholder="*********" onSubmit="return false;">
						</div>
						<div id = "cp2">
						<label for="newPas">Enter New Password:</label>
						<input type="password" class="form-control" id="newPas" placeholder="*********" onSubmit="return false;">
						</div>
						<div id = "cp3">
						<label for="conPas">Confirm New Password:</label>
						<input type="password" class="form-control" id="conPas" placeholder="*********" onSubmit="return false;">
						<p id = "feedbackChangePassword" style = "color: maroon"></p>
						</div>
					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
						<button type="button" class="btn btn-primary" onclick = "changePassword();">Change Password</button>
					</div>
				</div>
			</div>
		</div>
<!--Modal-CHANGE PASSWORD END-->
	
	
	
	
	
	
	
	
	
	<!--Initialization of needed bootstrap files-->
		<script src="jquery-3.2.1.js"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
<!--Initialization of needed bootstrap-select files-->		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<!-- (Optional) Latest compiled and minified JavaScript translation files -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
	</body>
	<script>
		var cross_checker = 0;
		var button_id_no = 1;
		var date = new Date();
		document.getElementById("date").innerHTML = "Date: <strong>"+date.toDateString() + "</strong>";
		
		var first = <?php echo  json_encode($_SESSION["account_firstname"]);?>;
		var last = <?php echo  json_encode($_SESSION["account_lastname"]);?>;
		var position = <?php echo  json_encode($_SESSION["account_position"]);?>;
		var office = <?php echo  json_encode($_SESSION["account_office"]);?>;
		var username = <?php echo  json_encode($_SESSION["user_name"]);?>;
		document.getElementById("employee_name").innerHTML = "Name\xa0\xa0\xa0\xa0: <strong>" + first +" "+last + "</strong>";
		document.getElementById("position").innerHTML = "Position: <strong>" + position  + "</strong>";
		document.getElementById("office").innerHTML = "Office\xa0\xa0\xa0: <strong>" + office  + "</strong>";
		document.getElementById("modal_Name").innerHTML = "Name\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0: " +first +" "+last;
		document.getElementById("modal_Username").innerHTML = "Username:\xa0"+username;
		
		function changePassword()
		{
		
			var pass = <?php  echo json_encode($_SESSION['pass_word']);?>;
			var old = document.getElementById("oldPas").value;
			var incomplete = true;
			var newPassValue = document.getElementById("newPas").value;
			//document.getElementById("feedbackChangePassword").innerHTML = "WHAT";
			if(document.getElementById("oldPas").value == "")
			{
				incomplete = false;
				document.getElementById("cp1").setAttribute("class", "form-group has-error");
			}
			if(document.getElementById("newPas").value == "")
			{
				document.getElementById("cp2").setAttribute("class", "form-group has-error");
				incomplete = false;
			}
			if(document.getElementById("conPas").value == "")
			{
				document.getElementById("cp3").setAttribute("class", "form-group has-error");
				incomplete = false;
			}
			if(!incomplete)
			{
				document.getElementById("feedbackChangePassword").innerHTML = "Kindly complete all needed input!";
			}
			else if(document.getElementById("newPas").value != document.getElementById("conPas").value)
			{
				document.getElementById("feedbackChangePassword").innerHTML = "Confirmation denied! New and Confirmation Password do not match!";
				document.getElementById("cp1").setAttribute("class", "form-group");
				document.getElementById("cp2").setAttribute("class", "form-group has-error");
				document.getElementById("cp3").setAttribute("class", "form-group has-error");
			}else
			{
				
				if(old == pass)
				{
					var confirm_really = confirm("Are you sure you want to change the password?");
					if(confirm_really)
					{
/***Code for Changing Password Begin***/
						$.ajax({
						type: 'POST',
						url: 'FunctionHelper.php',
						data:  {'function': 'changePassword', 'newPassword': newPassValue},
						//dataType: "json",
						success: function(response){
							document.getElementById("changeSuccessNot").innerHTML = "Password Change Successful!";
							document.getElementById("changeSuccessNot").setAttribute("style","display:show;");
					
						},
						error: function(req, response){
							alert("ERROR OCCURED! Code failure: please report to developers: "+response);
						}
						});
/***Code for Changing Password End***/						
						
						$('#modal-Operations').modal('hide');
					}
					
				}
				else
				{
					document.getElementById("feedbackChangePassword").innerHTML = "Incorrect Old Password!";
					document.getElementById("cp2").setAttribute("class", "form-group");
					document.getElementById("cp3").setAttribute("class", "form-group");
					document.getElementById("cp1").setAttribute("class", "form-group has-error");
				}
			}

		}
	</script>
</html>