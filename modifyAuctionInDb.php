<!-- Spremanje izmjena aukcije u bazu -->
<?php
	if (isset($_SESSION) === false) 
			session_start();
	try {
		$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
	}   
	catch( PDOException $e ) {
		echo "Greška: " . $e->getMessage(); exit();
	}
	if ((isset($_SESSION) === false) && $_SESSION['delete'] == 1){
		$db->exec("DELETE FROM products WHERE code = "."'".$_SESSION['code']."'" );
		$db->exec("DELETE FROM auctions WHERE product = "."'".$_SESSION['code']."'" );
		header("Location: index.php");
	}
	if($_SESSION['changeactivity']==1){
		$st = $db->query( "UPDATE auctions SET active= '0' WHERE product="."'".$_SESSION['code']."'");
		echo "tu ".$_SESSION['code'];
	}
	
	$filepath ="";
	//nove slike spremamo u direktoriju uploads
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["file_img"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	//Provjera je li korisnik uistinu uploadao sliku
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["file_img"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	if (file_exists($target_file)) {
		echo "File already exists.";
		$uploadOk = 0;
	}
	
	if ($_FILES["file_img"]["size"] > 500000) {
		echo "File is too large.";
		$uploadOk = 0;
	}
	// Dozvoljavamo samo sljedece formate slika
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		header("Location: index.php");
		$uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
		echo "File was not uploaded.";
		header("Location: index.php");
	//Pokusavamo uploadat file
	} else {
		if (move_uploaded_file($_FILES["file_img"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["file_img"]["name"]). " has been uploaded.";
		} else {
			echo "Error uploading your file.";
			header("Location: index.php");
		}
	}
	$filepath = $target_file;
	$st = $db->query( "UPDATE products SET imgPath="."'".$filepath."'"." WHERE code="."'".$_SESSION['code']."'");
 
	//Update baze
	if ( isset($_POST['titleInput'])&& $_POST['titleInput'] != "") 
		$st = $db->query( "UPDATE products SET title="."'".$_POST['titleInput']."'"." WHERE code="."'".$_SESSION['code']."'");
	
	if (isset($_POST['descriptionInput']) && $_POST['descriptionInput'] != "") 
		$st = $db->query( "UPDATE products SET description="."'".$_POST['descriptionInput']."'"." WHERE code="."'".$_SESSION['code']."'");
	
	if (isset($_POST['startingpriceInput']) && $_POST['startingpriceInput'] != "") 
		$st = $db->query( "UPDATE products SET startingPrice="."'".$_POST['startingpriceInput']."'"." WHERE code="."'".$_SESSION['code']."'");
	
	if (isset($_POST['sellnowInput']) && $_POST['sellnowInput'] != "") 
		$st = $db->query( "UPDATE products SET sellNow="."'".$_POST['sellnowInput']."'"." WHERE code="."'".$_SESSION['code']."'");
	
	if (isset($_POST['categoryInput']) && $_POST['categoryInput'] != "") 
		$st = $db->query( "UPDATE products SET category="."'".$_POST['categoryInput']."'"." WHERE code="."'".$_SESSION['code']."'");

	header("Location: index.php");
?>