<!DOCTYPE html>
<html>

<?php
	session_start();
	session_unset();
	session_destroy();
	echo "gg";
?>
</html>