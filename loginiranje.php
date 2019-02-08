<!--Logiranje na stranicu, poèetak sessiona. -->
<?php
	try {
		$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
	}   
	catch( PDOException $e ) {
		echo "Greška: " . $e->getMessage(); exit();
	}
	
	$usrname = isset($_POST['uname']) ? $_POST['uname'] : '';
	$st = $db->query( 'SELECT * FROM users WHERE username = '."'".$usrname."'" );
	$sifra = "";
	$admin = 0;
	foreach( $st->fetchAll() as $row ){
		 $sifra = $row[ 'password' ] ;
		 $admin = $row['admin'];
	}
	$pswrd= isset($_POST['passw']) ? $_POST['passw'] : '';
		 
	if($sifra == $pswrd){
		session_start();
		$_SESSION['username']=$_POST['uname'];
		$_SESSION['admin'] = $admin;
		header("Location: index.php");
	}
			
		
	else if (!isset($sifra) ){
		echo "Ne postoji taj korisnik!";
		header("Location: signup.php");
	}
	else
		echo "Kriva sifra!";  
?>