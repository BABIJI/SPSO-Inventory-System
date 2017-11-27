<html> 
<head> 
<title>Add New Record in MySQL Database</title> 
</head> 
<body> 
	<?php 
		require_once 'new.php';
	
		$supplyName = $_POST['name'];
		$supplyQuantity = $_POST['quantity'];
		$supplyPrice = $_POST['price'];
		$sql = "insert into supplies values('$supplyName', '$supplyQuantity', '$supplyPrice')";
		mysqli_select_db( 'SPSO' ); 
		$retval = mysqli_query($sql, $conn);
		if(! $retval ) { 
			die('Could not enter data: ' . mysqli_error()); 
		} 
		echo "Entered data successfully\n"; 
		mysqli_close($conn); 
	?> 
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
</body> 
</html>