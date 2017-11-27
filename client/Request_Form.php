<!DOCTYPE html>
<html>	
	<?php
		session_start();
	?>
	<head>
		<style>
			section{
				<!--text-align: right;-->
				border:1px solid black;
				margin-left: 300px;
				float: left;
				width:750px;
			}

			article {
				float: right;
				margin-right: 300px;
				<!--margin: 0 1.5%;-->
				width: 50%;
			}

			input{
				font-size:20px;
				color: maroon;
			}
			
			/* Full-width input fields */
			input[type=text], input[type=password] {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
			}

			/* Set a style for all buttons */
			#menuB{
				color: maroon;
				font-size:20px;
				margin: 8px 0;
				cursor: pointer;
				width: 100%;
			}
			
			.ButtonGroupC {
				color: maroon;
				font-size:20px;
				cursor: pointer;
				width: 20%;
				margin: 15px 0;
				border: 2px solid maroon;
			}

			button:hover {
				opacity: 0.8;
			}

			/* Extra styles for the cancel button */
			.cancelbtn {
				width: auto;
				padding: 10px 18px;
				background-color: #f44336;
			}

			/* Center the image and position the close button */
			.imgcontainer {
				text-align: center;
				margin: 24px 0 12px 0;
				position: relative;
			}

			img.avatar {
				width: 40%;
				border-radius: 50%;
			}

			.container {
				padding: 16px;
			}

			span.psw {
				float: right;
				padding-top: 16px;
			}

			/* The Modal (background) */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 90%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
				padding-top: 60px;
			}
			

			/* Modal Content/Box */
			.modal-content {
				background-color: #fefefe;
				margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
				border: 1px solid #888;
				width: 80%; /* Could be more or less, depending on screen size */
				
			}

			/* The Close Button (x) */
			.close {
				position: absolute;
				right: 25px;
				top: 0;
				color: #000;
				font-size: 35px;
				font-weight: bold;
				color: blue;
			}

			.close:hover,
			.close:focus {
				color: red;
				cursor: pointer;
			}

			/* Add Zoom Animation */
			.animate {
				-webkit-animation: animatezoom 0.6s;
				animation: animatezoom 0.6s
			}

			@-webkit-keyframes animatezoom {
				from {-webkit-transform: scale(0)} 
				to {-webkit-transform: scale(1)}
			}
    
			@keyframes animatezoom {
				from {transform: scale(0)} 
				to {transform: scale(1)}
			}

			/* Change styles for span and cancel button on extra small screens */
			@media screen and (max-width: 300px) {
				span.psw {
					display: block;
					float: none;
				}
				.cancelbtn {
					width: 100%;
				}
			}
<!--********************************************Insert Table Properties*******************************************-->
<!--********************************************Insert Table Properties*******************************************-->			
			.quantity {
				font-size: 16px;
				display: inline;
				padding: 8px;
				border: 2px solid maroon;
			}
			
			
			table{
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 750px;
				white-space:nowrap;
				color:maroon;
				
			}
			
			td, th{
				border: 2px solid maroon;
				text-align: center;
				padding: 8px;
				;
			}

			tr:nth-child(even) {
				background-color: #eee;
			}
			
			#a{
				rowspan = "2";
			}
			
			.arrowheadLeft{
				align:left;
			}
			
			.arrowheadRight{
				align:right;
			}
			


<!--********************************************Insert Table Properties*******************************************-->
<!--********************************************Insert Table Properties*******************************************-->			
		</style>
		
<!--********************************************Insert*******************************************-->
<!--********************************************Insert*******************************************-->	
		<?php
		$_SESSION["db"] = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($_SESSION["db"], "spso");
		$_SESSION["result"] = mysqli_query($_SESSION["db"], "SELECT stock_no, description, Unit FROM supplies");
		$_SESSION["myrow"] = mysqli_num_rows ( $_SESSION["result"]);
		
		/*gathering user account information BEGIN*/
		$_clientFrom = $_SESSION["type"].'_user_table';
		$us = $_SESSION["user_name"];
		$query1 = "SELECT e.* FROM employee e, $_clientFrom c WHERE e.employee_id = c.employee_id and c.username = '$us';";
		$account_info = mysqli_query($_SESSION["db"], $query1);
		if (!$account_info) {
			die('Invalid query: '.$_clientFrom);
		}
		$temp = mysqli_fetch_array($account_info);
		
		$_SESSION["account_id"] = $temp['employee_id'];
		$temp2 = $temp['employee_id'];
		$_SESSION["account_firstname"] = $temp['employee_firstname'];
		$_SESSION["account_lastname"] = $temp['employee_lastname'];
		$_SESSION["account_position"] = $temp['employee_position'];
		
		$query1 = 'SELECT office_name FROM employee_office_designation WHERE employee_id = \''.$temp2.'\';';
		$account_info = mysqli_query($_SESSION["db"], $query1);
		if (!$account_info) {
			die('Invalid query:'.$query1);
		}
		$temp = mysqli_fetch_array($account_info);
		$_SESSION["account_office"] = $temp['office_name'];
		/*gathering user account information END*/
		
		mysqli_close($_SESSION["db"]);
		
	?>
<!-- BEGIN Modal Successful Add Dialog Box-->	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="jquery-3.2.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		function showSuccess(){
			$( function() {
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			} );
		}
		
  </script>
<!-- END Modal Successful Add Dialog Box-->	
	<script>
		var record_number = <?php echo  json_encode($_SESSION["myrow"]);?>;
		
		function updateValue(id) {
			for(i = 0; i < record_number; i++){
				if((i+".right") == id){
					document.getElementById(i).innerHTML = parseInt(document.getElementById(i).innerHTML, 10)+1;
				}
				else if((i+".left") == id)
				{
					if((parseInt(document.getElementById(i).innerHTML, 10)) > 0){
						document.getElementById(i).innerHTML = parseInt(document.getElementById(i).innerHTML, 10)-1;
					}
					
				
				}
			}
		}
		//document.getElementById("quantity").innerHTML = document.getElementById("left").elements.length;
		
		</script>
		
		
		<script>
			
			function myAjax (clicked_id) {
				$.ajax({
					type: "POST",
					url: "php/AddQuantity.php",
					data: { name: clicked_id }
					error: function ( xhr ) {
						alert( "error" );
					}
				}).done(function( msg ) {
					//alert( "Incremented daw" + msg);
					window.location.reload();
				});

			};
			
			function resizeIframe(obj) {
				obj.style.height = 0;
    			obj.style.height = obj.contentWindow.document.body.scrollHeight + 50 + 'px';
  			}
		</script>
<!--********************************************Insert*******************************************-->
<!--********************************************Insert*******************************************-->			
	</head>
	<body style = "color: maroon;">
		<h1 style = "text-align: center;" id = "gg">
			Request Form
		</h1>
		<div id = "account_ui">
			<p id="date" style = "text-align: right; margin-right: 300px; font-size : 110%;"></p>
			<p id="employee_name" style = "text-align: left; margin-left: 300px; font-size : 110%;">0</p>
			<p id="position" style = " margin-top: -15px; text-align: left; margin-left: 300px; font-size : 110%;">0</p>
			<p id="office" style = " margin-top: -15px; text-align: left; margin-left: 300px; font-size : 110%;">0</p>
		</div>
		<form id = "purpose_input" style = "text-align: left; margin-right: 300px; margin-left: 300px;font-size : 120%" >
				Purpose:
			<!--<p style = "text-align: left; margin-left: 300px; font-size : 110%;">Purpose:</p>-->
				<input type = "text" id = "purpose" maxlength="50" name = "Purpose" style = "font-size : 75%; width: 45%; height: 90%; padding: 3px;"></input>
		</form>
		<script>
			var purpose= "(Not Specified)";
			var cross_checker = 0;
			$('#purpose_input').submit(function(e) {
					if(cross_checker == 0 && document.getElementById("purpose").value != ""){
						purpose = document.getElementById("purpose").value;
						document.getElementById("purpose_input").innerHTML = document.getElementById("purpose_input").innerHTML + "&#x2714";
						document.getElementById("purpose").value = purpose;
						cross_checker++;
					}
					else{
						purpose= "(Not Specified)";
						document.getElementById("purpose_input").innerHTML = 'Purpose:<input type = "text" id = "purpose" maxlength="50" name = "Purpose" style = "font-size : 75%; width: 45%; height: 90%; padding: 3px;"></input>';
					}
					e.preventDefault();
					       
			});
			
			var date = new Date();
			document.getElementById("date").innerHTML = "Date: "+date.toDateString();
			//var date = new Date();
			//document.getElementById("date").innerHTML = "Date: " + date.toUTCString();
			
			var first = <?php echo  json_encode($_SESSION["account_firstname"]);?>;
			var last = <?php echo  json_encode($_SESSION["account_lastname"]);?>;
			var position = <?php echo  json_encode($_SESSION["account_position"]);?>;
			var office = <?php echo  json_encode($_SESSION["account_office"]);?>;
		
			//var g = <?php echo  $_SESSION["account_position"];?>;
			
			document.getElementById("employee_name").innerHTML = "Name: " + first +" "+last;
			document.getElementById("position").innerHTML = "Position: " + position;
			document.getElementById("office").innerHTML = "Office: " +office;
		</script>
		<section>
<!--********************************************Insert*******************************************-->		
<!--********************************************Insert*******************************************-->
<!--********************************************Insert*******************************************-->		
		<?php
		echo'<table align = "center">
			<col width="50">
			<col width="50">
			<col width="400">
			<col width="100">	
			<tr>
				<th id = "a">Stock No.</th>
				<th id = "a">Unit</th>
				<th id = "a">Description</th>
				<th id = "a">Qty</th>
			</tr>
		';
		$_SESSION["db"] = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($_SESSION["db"], "spso");
		$_SESSION["result"] = mysqli_query($_SESSION["db"], "SELECT stock_no, description, Unit FROM supplies");
		$x = 0;
		while($_SESSION["myrow"] = mysqli_fetch_array($_SESSION["result"]))
		{
			echo	'<tr>';
			echo	'<td id = "'.$x.'.stock">';		echo $_SESSION["myrow"]["stock_no"];	echo'</td>';
			echo	'<td id = "'.$x.'.unit">';		echo $_SESSION["myrow"]["Unit"];		echo'</td>';
			echo	'<td id = "'.$x.'.descrptn">';		echo $_SESSION["myrow"]["description"];	echo'</td>';
			echo	'<td><button type="button" onclick = updateValue(this.id) id ="'.$x.'.left"';
			echo	'">&lArr;</button>';
							echo '<p id = "'.$x.'" class = "quantity" style = "display:inline; margin: 20px" >0</p>';	
			echo '<button type="button" onclick = updateValue(this.id) id = "'.$x.'.right"';
			echo'">&rArr;</button>';
			echo'</td></tr>';
			$x++;
		}
		echo '</table>';
		mysqli_close($_SESSION["db"]);
		//session_unset();
		//session_destroy();
		//session_start();
		?>	
		
		<!-- this is Request_Form Cancel and Submit-->
		<div style = "text-align: right; margin: 0px">
		<input type="button" onclick="location.href = 'Client_Menu.html';" class = "ButtonGroupC" value="Cancel"> 
		<input type="submit" class = "ButtonGroupC" id="btnPopModal" onclick="getTableChange(); document.getElementById('submitButton').style.display='block';" value="Submit">
		</div>
		</section>
<!--********************************************Insert*******************************************-->
<!--********************************************Insert*******************************************-->
<!--********************************************Insert*******************************************-->		
		<section>

			<div id="submitButton" class="modal">
				 <form class="modal-content animate" action="">
					<div class="imgcontainer">
						<span onclick="document.getElementById('submitButton').style.display='none'" class="close" title="Close Modal">&times;</span>
					</div>
						<div class="container" id = "contain">
						
						</div>

					<div class="container" id = "containB" style="background-color:#f1f1f1">
						<!--	<button type="button" id = "menuB" onclick="document.getElementById('submitButton').style.display='none';" class="cancelbtn">Cancel</button>
								<button type="button" id = "menuB">Submit</button>
						-->
					</div>
				</form>
			</div>
			
			
			
			<script>
				// Get the modal
				var modal = document.getElementById('submitButton');

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
					if (event.target == modal) {
						modal.style.display = "none";
						var x = 0;
						var i = 0;
						var result = "";
						document.getElementById("contain").innerHTML = result;
					}

				}
				var y = 0;
				function getTableChange(){
					var x = 0;
					var i = 0;
					
					var result = "";
					var account_Info_part_Modal = "<h1 style = \"text-align: center; font-size : 150%;\">Request Summary</h1>"+
												"<p style = \"text-align: left; margin-left: 150px; font-size : 110%;\">"+document.getElementById("date").innerHTML+"</p>"+
												"<p style = \"text-align: left; margin-top: -15px; margin-left: 150px; font-size : 110%;\">"+document.getElementById("employee_name").innerHTML+"</p>"+
												"<p style = \" margin-top: -15px; text-align: left; margin-left: 150px; font-size : 110%;\">"+ document.getElementById("position").innerHTML +"</p>"+
												"<p style = \" margin-top: -15px; text-align: left; margin-left: 150px; font-size : 110%;\">"+ document.getElementById("office").innerHTML+"</p>"+
												"<p style = \" margin-top: -15px; text-align: left; margin-left: 150px; font-size : 110%;\">"+ "Purpose: "+purpose+"</p>"+
												"<h2 style = \"text-align: center; font-size : 150%;\">Requested Supplies</h2>";
					
					/*******BEGIN Method for Generating Table UI/Content in Modal**********/
					for(i = 0; i < record_number; i++)
					{
						if((parseInt(document.getElementById(i).innerHTML, 10)) > 0){
							if(x == 0){
								var init = '<table align = "center">'+
											'<col width="50">'+
											'<col width="50">'+
											'<col width="400">'+
											'<col width="100">'+
											'<tr>'+
											'<th id = "a">Stock No.</th>'+
											'<th id = "a">Unit</th>'+
											'<th id = "a">Description</th>'+
											'<th id = "a">Qty</th>'+
											'</tr>';
								//result = init;
								x++;
								
								result = init +	'<tr>'+
										'<td id ="'+ y +'.send1">'+ document.getElementById(i+".stock").innerHTML		+	'</td>'+
										'<td>'+	document.getElementById(i+".unit").innerHTML		+	'</td>'+
										'<td>'+	document.getElementById(i+".descrptn").innerHTML	+	'</td>'+
										'<td><p id ="'+ y +'.send2">'+	document.getElementById(i).innerHTML			+	'</p></td>' +
										'</tr>';
								y++;
							}
							else{
								result = result +	'<tr>'+
										'<td id ="'+ y +'.send1">'+ document.getElementById(i+".stock").innerHTML		+	'</td>'+
										'<td>'+	document.getElementById(i+".unit").innerHTML		+	'</td>'+
										'<td>'+	document.getElementById(i+".descrptn").innerHTML	+	'</td>'+
										'<td"><p id ="'+ y +'.send2>'+	document.getElementById(i).innerHTML			+	'</p></td>' +
										'</tr>';
								y++;
							}
						}
					}//end for loop
					if(x > 0){
						result = result + '</table>';
						yesChoice();
					}
					else
					{
						result ='<h3 style = "text-align:center">(Empty Request!)</h3>';
						noChoice();
					}
					/*******END Method for Generating Table UI/Content in Modal**********/
					document.getElementById("contain").innerHTML = account_Info_part_Modal + result;
					
				}
				
				function noChoice(){
					var rs = '<button type="button" id = "menuB" onclick="document.getElementById(\'submitButton\').style.display=\'none\';" class="cancelbtn">Back</button>';
					document.getElementById("containB").innerHTML = rs;
				}
				
				function yesChoice(){
					var rs = '<button type="button" id = "menuB" onclick="document.getElementById(\'submitButton\').style.display=\'none\';" class="cancelbtn">Cancel</button>'+
								'<button type="button" id = "menuB" onclick = "addRequest()" >Submit</button>';
					document.getElementById("containB").innerHTML = rs;
				}
				
				function addRequest(){
					var d = new Date();
					var employee_id = <?php echo  json_encode($_SESSION["account_id"]);?>;
					var RIS_NO = first.charAt(0)+last.charAt(0)+"-"+d.getTime();
					var data_to_be_send = {};
					//alert(y);
					data_to_be_send['ris_no'] = RIS_NO;	
					data_to_be_send['purpose'] = purpose;
					data_to_be_send['employee_id'] = employee_id;
					data_to_be_send['number_of_requested_supplies'] = y;
					var g = 0;
					for( g = 0; g < y; g++)
					{
						var stock = g+".stock";
						var qty = g+".qty";
						data_to_be_send[stock] = document.getElementById(g+".send1").innerHTML;
						data_to_be_send[qty] = document.getElementById(g+".send2").innerHTML;
					}
					var JSONInput = JSON.stringify(data_to_be_send);
					$.ajax({
							type: 'POST',
							url: 'Add_to_RIS.php',
							data:  data_to_be_send,
							//dataType: "json",
							success: function(response){
								alert("well, it worked?" + response);
							},
							error: function(req, response){
								alert("shet mygad 1:13AM na bakit may error"+response);
							}
					});	
					showSuccess();
					
				}
				
				function sendtoRISTable(){
					
				}
				
				/* BEGIN Initialize Account Info on Request_formPage*/
				/* END Initialize Account Info on Request_formPage*/
				</script>
		</section>
		
		<div id="dialog-message" title="Request Sent" style = "display: none;">
			<p>
				<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
				Request have been Succcessfully Sent
			</p>
		</div>
	</body>
</head>