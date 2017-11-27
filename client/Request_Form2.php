<!DOCTYPE html>
<html lang = "en">	
	<?php
		session_start();
	?>
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<style>
			#menuB, #menuC{
				font-size: 20px;
			}
			
			#operation_buttons
			{
				
				width: 30%;
				margin-left: 20%;
				display: inline-block;
			}
			
			#operation_buttons2{
				text-align: right;
				width: 30%;
				margin-right: 19%;
				display: inline-block;
			}
			
			th, td{
				text-align: center;
			}
			
			#a{
				text-align: center;
			}
			
			#EmptyListErrorContainer
			{
				width:60%;
				text-align: center;
				margin-left: 20%;
			}
			
		</style>
	</head>
	<body style = "font-size: 15px;">
		
		<p id="date" style = "text-align: right; margin-right: 300px; font-size : 110%;"></p>
		<h1 style = "text-align: center;" id = "gg">
			Request Form
		</h1>
<!---->	<div id = "account_ui" style = " margin-left: 20%;">
			<p class = "lead" id="employee_name" style = "text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="position" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
			<p class = "lead" id="office" style = " margin-top: -15px; text-align: left; font-size : 110%;">0</p>
		</div>
		
<!---->	<div id = "operation_buttons">
			<button type="button" class="btn btn-primary" id = "menuB" data-toggle="modal" data-target=".bd-example-modal-lg" onclick = "initializeModalAdd();">Add Items</button>
		</div>		
		<div id = "operation_buttons2">
			<button type="button" onclick="location.href='Client_Menu.php';" class="btn btn-primary" id = "menuC">Back</button>
			<button type="button" class="btn btn-primary" id = "menuC" onclick = "submit_as_RIS();" >Submit</button>
		</div>
		<div><p><br></p></div>
<!---->	<div style = "width: 30%;margin-left: 20%;">
			<form id = "purpose_input">
				<div class="form-group">
					<div  style =  "width: 100%; display: inline-block;" id = "purposeGroup">
						<label for="PurposeSelect">Purpose:</label>
						<input type="text" class="form-control" id="PurposeSelect" placeholder="Enter purpose here" onSubmit="return false;">
					</div>
				</div>
			</form>
		</div>
<!---->	<div id = "selected-items">
			<table class="table table-hover table-striped" align = "center" style = "width: 70%;" >
				<col width="50">
				<col width="50">
				<col width="400">
				<col width="100">
				<col width="50">				
				<tr>
					<th id = "a">Stock No.</th>
					<th id = "a">Unit</th>
					<th id = "a">Description</th>
					<th id = "a">Qty</th>
					<th id = "a">edit/delete</th>
				</tr>
			</table>
		</div>
		<div class="alert alert-danger" id = "EmptyListErrorContainer" role="alert" style = "display:none;">
			Error! Empty List!
		</div>
		
<!--Modal for Add Items-->		
		<div id = "modal-ADD" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="ModalLabel" style = "display: inline-block;">Add Items</h3>
						<button type="button" class="close " data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">					
						<form>
							<div class="form-group">
								<div style = "width: 60%; display: inline-block;" id = "selectDiv">
									<label for="ItemSelect" id = "selectLabel">Items:</label>
									<select class="form-control selectpicker" id="item-Select" value = "none" data-live-search="true" onchange="changeUnit(this.value)">
										<option data-tokens = "none" selected style = "display: none;">Select Item</option>
										<?php
											$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
											if (mysqli_connect_errno())
											{
												echo "Failed to connect to MySQL: " . mysqli_connect_error();
											}
											mysqli_select_db($db, "spso");
											$result = mysqli_query($db, "SELECT description FROM supply;");
											$x = 0;
											while($myrow = mysqli_fetch_array($result))
											{
												echo	'<option data-tokens = "'. $myrow["description"].'" id = "'.$x.'.Unit">'.$myrow["description"].'</option>';
												$x++;
											}
											mysqli_close($db);
										?>
									</select>
									 <small id="ItemError" class="form-group has-error" style = "display: none;"></small>
									
								</div>
								<div style = "width: 15%; display: inline-block;">
									<label for="Unit">Unit:</label>
									<input type="text" class="form-control" id="UnitSelect" placeholder="n/a" readonly>
									<small id="UnitError" class="form-group has-error" style = "display: none;"> &nbsp;</small>
								</div>
								<div  style = "width: 20%; display: inline-block;" id = "qtygroup">
									<label for="QuantitySelect">Quantity:</label>
									<input type="number" class="form-control" id="QuantitySelect" placeholder="e.g 1, 2, 3, etc.">
									<small id="QuantityError" class="form-group has-error" style = "display: none;"> &nbsp;</small>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" onclick = "saveSelectedChanges()">Add</button>
					</div>
				</div>
			</div>
		</div>
		
<!--Modal-EDIT-->
	<div id = "modal-EDIT" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="ModalLabel" style = "display: inline-block;">Edit Selected Item</h3>
						<button type="button" class="close " data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">					
						<form>
							<div class="form-group">
								<div style = "width: 60%; display: inline-block;" id = "selectedDiv">
									<label for="ItemSelected" id = "selectLabel">Items:</label>
									<input type="text" class="form-control" id="ItemSelected" placeholder="Really" readonly>
									<small id="editItemError" class="form-group has-error" style = "display: none;">&nbsp;</small>
								</div>
								<div style = "width: 15%; display: inline-block;">
									<label for="UnitSelected">Unit:</label>
									<input type="text" class="form-control" id="UnitSelected" placeholder="WAT" readonly>
									<small id="editUnitError" class="form-group has-error" style = "display: none;"> &nbsp;</small>
								</div>
								<div  style = "width: 20%; display: inline-block;" id = "selectedqtygroup">
									<label for="QuantitySelected">Quantity:</label>
									<input type="number" class="form-control" id="QuantitySelected" placeholder="">
									<small id="editQuantityError" class="form-group has-error" style = "display: none;"> &nbsp;</small>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" onclick = "editChanges();">Save Changes</button>
					</div>
				</div>
			</div>
		</div>
<!--Modal-EDIT_END-->
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
								'<th id = "a">edit/delete</th>'+
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
			
			
			
		function initializeModalAdd(){
			
		}
			
		$('#purpose_input').submit(function(e) {
			var posInput = /(?=.*[a-zA-Z])/;
			if(cross_checker == 0 && posInput.test(document.getElementById("PurposeSelect").value)){
				purpose = document.getElementById("PurposeSelect").value;
				document.getElementById("PurposeSelect").value = purpose;
				cross_checker++;
			}
			else{
				purpose= "(Not Specified)";
			}
			e.preventDefault();
				       
		});
		
		
		$(function() {
			$('.selectpicker').selectpicker();
		});
		
		var stock_no_storage = "";
		
		function changeUnit(value){
			document.getElementById("item-Select").setAttribute("value", value);
			$.ajax({
				type: 'POST',
				url: 'SelectUnit.php',
				data:  {'description': value},
				dataType: "json",
				success: function(response){
					stock_no_storage = response["stock"];
					document.getElementById("UnitSelect").setAttribute("placeholder", response["unit"]);
					
				},
				error: function(req, response){
					alert("ERROR OCCURED!"+response);
				}
			});
		}
		
		function saveSelectedChanges(){
			/*
			QuantitySelect
			item-Select
			*/
			if(document.getElementById("item-Select").getAttribute("value") == "none")
			{
				document.getElementById("qtygroup").setAttribute("class", "form-group");
				document.getElementById("selectDiv").setAttribute("class", "form-group has-error");
				document.getElementById("ItemError").innerHTML = "Empty item selected!";
				document.getElementById("ItemError").setAttribute("style", "display: show");
					
				document.getElementById("UnitError").innerHTML = "&nbsp;";
				document.getElementById("UnitError").setAttribute("style", "display: show");
				
				document.getElementById("QuantityError").innerHTML = "&nbsp;";
				document.getElementById("QuantityError").setAttribute("style", "display: show");
			}
			else{
				if(document.getElementById("QuantitySelect").value <= 0 || isNaN(document.getElementById("QuantitySelect").value) == true)
				{
					document.getElementById("selectDiv").setAttribute("class", "form-group");
					document.getElementById("qtygroup").setAttribute("class", "form-group has-error");
					document.getElementById("QuantityError").innerHTML = "Invalid Quantity selected!";
					document.getElementById("QuantityError").setAttribute("style", "display: show");
					
					document.getElementById("ItemError").innerHTML = "&nbsp;";
					document.getElementById("ItemError").setAttribute("style", "display: show");
					
					document.getElementById("UnitError").innerHTML = "&nbsp;";
					document.getElementById("UnitError").setAttribute("style", "display: show");
				}
				else{ //Success, all input valid
					var i = 1;
					var idStock= "";
					var dup = false;
					
					for(i = 1; i <= button_id_no-1; i++)
					{
						idStock = i+".stock";
						if(document.getElementById(idStock).innerHTML == stock_no_storage)
						{
							dup = true;
							break;
						}
					}
					if(dup)
					{
						
						var num = parseInt(document.getElementById(i+".qty").innerHTML, 10) + parseInt(document.getElementById("QuantitySelect").value, 10);
						document.getElementById(i+".qty").innerHTML = num;
					}
					else
					{
						buttonGroup_string ='<div><button class="btn btn-success btn-xs" onclick = "edit_entry('+ button_id_no +');" data-toggle="modal" data-target=".bd-example-modal-sm" id ="'+ button_id_no +'.edit">edit</button>'+
										'<button class="btn btn-success btn-xs" onclick = "delete_entry('+ button_id_no +');" id ="'+ button_id_no +'.delete">delete</button>'+
										'</div>';
						table_new = table_new +
								'<tr>'+
									'<td id = "'+ button_id_no +'.stock">'+ stock_no_storage+'</td>'+
									'<td id = "'+ button_id_no +'.unit">'+ document.getElementById("UnitSelect").getAttribute("placeholder")+'</td>'+
									'<td id = "'+ button_id_no +'.desc">'+ document.getElementById("item-Select").getAttribute("value")+'</td>'+
									'<td id = "'+ button_id_no +'.qty">'+ document.getElementById("QuantitySelect").value+'</td>'+
									'<td>'+ buttonGroup_string+'</td>'+
								'</tr>';
						button_id_no++;
						document.getElementById("selected-items").innerHTML = table_new+"</table>";
						document.getElementById("EmptyListErrorContainer").setAttribute("style", "display: none;");
					}
			
					
					$('#modal-ADD').modal('hide');
				}
			}
			
		}
		
		
		function delete_entry(val)
		{
			alert("deleting" + val + " "+button_id_no);
			var i = 0;
			var x = 1;
			var temp = table_string;
			for(i = 1; i < button_id_no; i++)
			{
				if(i != val)
				{
					var temp_buttonGroup_string ='<div><button class="btn btn-success btn-xs" onclick = "edit_entry('+ x +');" data-toggle="modal" data-target=".bd-example-modal-sm" id ="'+ x +'.edit">edit</button>'+
										'<button class="btn btn-success btn-xs" onclick = "delete_entry('+ x +');" id ="'+ x +'.delete">delete</button>'+
										'</div>';
					temp = temp +
							'<tr>'+
								'<td id = "'+ x +'.stock">'+ document.getElementById(i+".stock").innerHTML+'</td>'+
								'<td id = "'+ x +'.unit">'+ document.getElementById(i+".unit").innerHTML+'</td>'+
								'<td id = "'+ x +'.desc">'+ document.getElementById(i+".desc").innerHTML+'</td>'+
								'<td id = "'+ x +'.qty">'+ document.getElementById(i+".qty").innerHTML+'</td>'+
								'<td>'+ temp_buttonGroup_string+'</td>'+
							'</tr>';
					x++;
				}
			}
			table_new = temp;
			button_id_no = button_id_no-1;
			document.getElementById("selected-items").innerHTML = table_new+"</table>";
		}
		
		var to_be_edited = 0;
		function edit_entry(val)
		{
			to_be_edited = val;
			document.getElementById("ItemSelected").setAttribute("value", document.getElementById(val+".desc").innerHTML);
			document.getElementById("UnitSelected").setAttribute("value", document.getElementById(val+".unit").innerHTML);
			document.getElementById("QuantitySelected").setAttribute("value", document.getElementById(val+".qty").innerHTML);
			
		}
		
		function editChanges()
		{
			if(document.getElementById("QuantitySelected").value <= 0 || isNaN(document.getElementById("QuantitySelect").value) == true)
				{
					document.getElementById("selectedDiv").setAttribute("class", "form-group");
					document.getElementById("selectedqtygroup").setAttribute("class", "form-group has-error");
					document.getElementById("editQuantityError").innerHTML = "Invalid Quantity selected!";
					document.getElementById("editQuantityError").setAttribute("style", "display: show");
					
					document.getElementById("editItemError").innerHTML = "&nbsp;";
					document.getElementById("editItemError").setAttribute("style", "display: show");
					
					document.getElementById("editUnitError").innerHTML = "&nbsp;";
					document.getElementById("editUnitError").setAttribute("style", "display: show");
				}
				else{
					document.getElementById(to_be_edited+".qty").innerHTML = document.getElementById("QuantitySelected").value;
					$('#modal-EDIT').modal('hide');
				}
				
		}
		
		function submit_as_RIS()
		{
			if(validate())
			{
				var d = new Date();
				var employee_id = <?php echo  json_encode($_SESSION["account_id"]);?>;
				var RIS_NO = d.getFullYear();
				var data_to_be_send = {};
				var datetime = d.getDate() + "/"
								+ (d.getMonth()+1)  + "/" 
								+ d.getFullYear() + " @ "  
								+ d.getHours() + ":"  
								+ d.getMinutes() + ":" 
								+ d.getSeconds();
				data_to_be_send['ris_no'] = RIS_NO;
				data_to_be_send['purpose'] = purpose;
				data_to_be_send['dateAndTime'] = datetime;
				data_to_be_send['employee_id'] = employee_id;
				data_to_be_send['number_of_requested_supplies'] = button_id_no-1;
				var g = 1;
				for( g = 1; g < button_id_no; g++)
				{
					
					var stock = g+'.stock';
					var qty = g+'.qty';
					data_to_be_send[stock] = document.getElementById(g+".stock").innerHTML;
					data_to_be_send[qty] = document.getElementById(g+".qty").innerHTML;
				}
				var JSONInput = JSON.stringify(data_to_be_send);
				$.ajax({
						type: 'POST',
						url: 'Add_to_RIS.php',
						data:  data_to_be_send,
						success: function(response){
							alert("well, it worked?" + response);
						},
						error: function(req, response){
							alert("shet mygad 3:00AM na bakit may error what is life"+response);
						}
				});	
			}
			else
			{
				document.getElementById("EmptyListErrorContainer").setAttribute("style", "display: show");
			}
		}
		
		function validate()
		{
			if(button_id_no == 1)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	</script>
</html>