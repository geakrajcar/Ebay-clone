<!-- Odlogiranje trenutno logiranog korisnika, završetak sessiona.-->
<?php
    
	session_start();

	session_unset(); 
    session_destroy();
	
	header("Location: index.php");

?>