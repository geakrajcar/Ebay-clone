<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
    <script>
	<!--Funkcija za validaciju forme za LOG IN -->
	function validateForm(){
		var x = document.forms["myForm"]["uname"].value;
		if (x == null || x == "") {
        alert("Username must be filled out");
        return false;
		}
		if (x.length > 15) {
			alert("Username is too long.");
			return false;
		}
		var y = document.forms["myForm"]["passw"].value;
		if (y == null || y=="") {
			alert("Password must be filled out");
			return false;
		}
		if (y.length > 15) {
			alert("Password is too long.");
			return false;
		}
	}
	</script>
</head>
<body>
<br/>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">BID ON THIS</a>
		</div>
		<div class="navbar-collapse ">
			<ul class="nav navbar-nav pull-right">
				<li class="active"><a href="index.php">HOME</a></li>
				<!--Prikaz navigation bara za logirane korisnike i administratora -->
				<?php
				if (isset($_SESSION) === false) 
					session_start();
				
				if(isset($_SESSION['username'])){
					if($_SESSION['admin']==1){
						$link = "adminProfile.php";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'.$link.'"'.">" .$_SESSION['username']."</a></li>";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."logout.php".'"'.">" ."LOGOUT"."</a></li>";
					}
					else{
						$link = "myProfile.php";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."newAuction.php".'"'.">" ."SELL"."</a></li>";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'.$link.'"'.">" .$_SESSION['username']."</a></li>";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."logout.php".'"'.">" ."LOGOUT"."</a></li>";
					}
				}
				else
					echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."signup.php".'"'.">" ."GUEST"."</a></li>";
				?>
			</ul>
		</div>
	  </div>
	</div>
	
	<!-- Ukoliko nitko nije logiran, ispod navigation bara prikazujemo kratku formu za LOG IN i button za SIGN UP -->
	<?php 
		if (isset($_SESSION) === false) 
					session_start();
		
		if (isset($_SESSION['username']) === false){
		session_unset(); 
		session_destroy();
		echo "<div class=".'"'."container-fluid content text-center".'"'." style=".'"'."padding-top:20px".'"'.">".
		"<form name=".'"'."myForm".'"'." action =".'"'."loginiranje.php".'"'. " method=".'"'."post".'" '." onsubmit=".'"'."return validateForm()".'"'." class =".'"'."form-inline".'"'.">".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'." style=".'"'."width:220px;".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">". "<span class=".'"'."glyphicon glyphicon-user".'"'.">"."</span></span>".
		"<input type=".'"'."text".'"'." name=".'"'."uname".'"'." class=".'"'."form-control".'"'." placeholder=".'"'."Username".'"'."/>".
		"</div></div>"."<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'." style=".'"'."width:220px".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">"."<span class=".'"'."glyphicon glyphicon-lock".'"'.">"."</span></span>".
		"<input type=".'"'."password".'"'." name=".'"'."passw".'"'." class=".'"'."form-control".'"'." placeholder=".'"'."Password".'"'."/>".
		"</div></div>"."<button type=".'"'."submit".'"'." class=".'"'."btn btn-log".'"'.">"."LOG IN"."</button>".
		"<a href=".'"'."signup.php".'"'." class=".'"'."btn btn-log".'"'." role=".'"'."button".'"'.">"."SIGN UP"."</a>".
		"</form>"."</div>";

		} 
	 ?>
	
	<!--Prikaz kategorija koje nas vode na aukcije-->
	<div class="container content text-center ">
    <?php 
		//admin i logirani korisnik imaju drugačiji prikaz aukcija, stoga vode na različite .php 
        if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
            $action = "adminCategoryItems.php";
        else
            $action = "categoryItems.php";
        echo "<form action = ".'"'.$action.'"'." method=".'"'."post".'"'." >";
        
        //Spajanje na bazu i ispis kategorija
         try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( "SELECT * FROM category" );
        foreach( $st->fetchAll() as $row ){
            $categoryName = $row['title'];
            $imagePath    = $row['imgPath'];

            echo "<div class = ".'"'."col-sm-3 img-box".'"'.">
            <h2 class=".'"'."intro-text-l".'"'." >".$categoryName."</h2>
            <hr>
            <input type=".'"'."image".'"'." src = ".'"'.$imagePath.'"'." name=".'"'.$categoryName.'"'." >
            </div>";
        }     
    ?>
		</form>
    </div>

	<!--Footer stranice -->
	<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left">Made by Leonora & Gea</p>
        </div>
    </div>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>