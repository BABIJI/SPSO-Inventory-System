<html> 
<head>
</head> 
<body> 
	
	<form method="post" action="<?php $_PHP_SELF ?>"> 
		<table width="600" border="0" cellspacing="1" cellpadding="2"> 
			<tr> 
				<td width="250">Name</td> 
				<td> 
					<input name="supplyName" type="text" id="name"> 
				</td> 
			</tr> 
			
			<tr> 
				<td width="250">Quantity</td> 
				<td> 
					<input name="supplyQuantity" type="text" id="quantity"> 
				</td> 
			</tr> 
			
			<tr> 
				<td width="250">Price</td> 
				<td> 
					<input name="supplyPrice" type="text" id="price"> 
				</td> 
			</tr> 
			
			<tr> 
				<td width="250"> </td> 
				<td> </td> 
			</tr> 
			
			<tr> 
				<td width="250"> </td> 
				<td> 
					<input name="add" type="submit" id="add" value="Add"> 
				</td> 
			</tr> 
		</table> 
	</form>  
	
	<?php 
		require_once 'new.php';
	
		mysqli_select_db($conn, 'SPSO'); 
		
		$name = $_POST['supplyName'];
		if(!get_magic_quotes_gpc()){
			$name = addslashes($_POST['supplyName']);
			$quantity = addslashes($_POST['supplyQuantity']);
		}else{
			$name = $_POST['supplyName'];
			$quantity = $_POST['supplyQuantity'];
		}
		$price = $_POST['supplyPrice'];
		
		$sql = "insert into supplies values('$name', '$quantity', '$price', '20')";
		$retval = mysqli_query($conn, $sql);
		
		if(! $retval ) { 
			die('Could not enter data: ' . mysqli_error()); 
		} 
		
		echo "Entered data successfully\n"; 
		#mysqli_close($conn); 
	?> 
</body> 
</html>