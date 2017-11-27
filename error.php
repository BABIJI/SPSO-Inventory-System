<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: Log_In.php" );
    endif;
    ?>
    </p>     
    <a href="Log_In.php"><button class="button button-block"/>Back</button></a>
</div>
</body>
</html>