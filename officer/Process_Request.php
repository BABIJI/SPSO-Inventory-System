<!DOCTYPE html>
<html lang = "en">
	<?php
		session_start();
		//header('Cache-Control: no-cache, must-revalidate');
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
			
			th, td{
				text-align: center;
			}
			
			#a{
				text-align: center;
			}
		</style>
	</head>
	<body style = "font-size: 15px;">
				
		<p id="date" style = "text-align: right; margin-right: 300px; font-size : 110%;"></p>
		<h1 style = "text-align: center;" id = "gg">
			Process RIS
		</h1>
<!---->	<div id = "account_ui" style = " margin-left: 20%;">
			<p class = "lead" id="employee_name" style = "text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="position" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="office" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
		</div>
		
<!---->	<div id = "operation_buttons">
			<button type="button"  onclick="location.href='Admin_Menu.html';" class="btn btn-primary" id = "menuB" onclick = "initializeModalAdd();">Back</button>
		</div>		
		<div><p><br></p></div>
		
<!---->	<div id = "operation_buttons" style = "width: 20%;";>
			<label for="ItemSelect" id = "selectLabel">Sort by:</label>
			<select class="form-control selectpicker" id="item-Select" value = "none" data-live-search="true" onchange="">
				<option data-tokens = "none" selected style = "display: none;">Select Item</option>
			</select>
				<small id="ItemError" class="form-group has-error" style = "display: none;"></small>
		</div>		
		<div><p><br></p></div>
		
<!--Modal-VIEW-->
	<div id = "modal-VIEW" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="ModalLabel" style = "display: inline-block;">RIS</h3>
						<button type="button" class="close " data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
<!--Enter data here--><div class="modal-body" id = "table_view_body">					
						
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
					</div>
				</div>
			</div>
		</div>
<!--Modal-VIEWs_END-->
		
<!---->	<div id = "selected-items">
			<table class="table table-hover table-striped" align = "center" style = "width: 65%;" >
				<col width="50">
				<col width="200">
				<col width="50">
				<col width="70">
				<col width="40">				
				<tr>
					<th id = "a">RIS No.</th>
					<th id = "a">Purpose</th>
					<th id = "a">Date</th>
					<th id = "a">Status</th>
					<th id = "a">Operation</th>
				</tr>
				<?php
					$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
					if (mysqli_connect_errno())
					{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					mysqli_select_db($db, "spso");
					$result = mysqli_query($db, "SELECT * FROM ris ORDER BY RIS_no DESC;");
					$x = 0;
					while($myrow = mysqli_fetch_array($result))
					{
						echo '<td id = "'.$x.'.ris">'.$myrow["RIS_no"].'</td>';
						echo '<td id = "'.$x.'.date">'.$myrow["Purpose"].'</td>';
						echo '<td id = "'.$x.'.pur">'.$myrow["date_and_time"].'</td>';
						echo '<td id = "'.$x.'.status">'.$myrow["status"].'</td>';
						echo '<td>';
						echo 	'<div>';
						echo 		'<button class="btn btn-success btn-xs" onclick = "process('.$x.');" data-toggle="modal" data-target=".bd-example-modal-sm" id ="'. $x .'.process">Process</button>';
						echo 	'</div>';
						echo '</td>';
						echo '</tr>';
						$x++;
					}
					mysqli_close($db);
				?>
			</table>
		</div>


		
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
		//alert("loaded?");
		var table_string = '<table class="table table-hover table-striped" align = "center" style = "width: 70%;" >'+
							'<col width="50">'+
							'<col width="50">'+
							'<col width="400">'+
							'<col width="100">'+
							'<col width="50">'+			
							'<tr>'+
								'<th id = "a">Stock No.</th>'+
								'<th id = "a">Unit</th>'+
								'<th id = "a">Description</th>'+
								'<th id = "a">Qty</th>'+
							'</tr>';
		var table_new = table_string;
		var purpose= "(Not Specified)";
		var cross_checker = 0;
		var button_id_no = 1;
		var date = new Date();
		document.getElementById("date").innerHTML = "Date: <strong>"+date.toDateString() + "</strong>";
		
		var first = <?php echo  json_encode($_SESSION["account_firstname"]);?>;
		var last = <?php echo  json_encode($_SESSION["account_lastname"]);?>;
		var position = <?php echo  json_encode($_SESSION["account_position"]);?>;
		var office = <?php echo  json_encode($_SESSION["account_office"]);?>;

		document.getElementById("employee_name").innerHTML = "Name\xa0\xa0\xa0\xa0: <strong>" + first +" "+last + "</strong>";
		document.getElementById("position").innerHTML = "Position: <strong>" + position  + "</strong>";
		document.getElementById("office").innerHTML = "Office\xa0\xa0\xa0: <strong>" + office  + "</strong>";
		
		
		function process(i)
		{
			
		}
	</script>
</html>