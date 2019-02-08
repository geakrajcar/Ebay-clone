<!-- Dodavanje nove aukcije -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; New Auction</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
    <script>
		<!-- Funkcija za validaciju forme za dodavanje nove aukcije -->
		function validateAuctionForm(){
			var x = document.forms["auctionForm"]["titleInput"].value;
			var y = document.forms["auctionForm"]["descriptionInput"].value;
			var v = document.forms["auctionForm"]["startingpriceInput"].value;
			var w = document.forms["auctionForm"]["sellnowInput"].value;
			if  (x.length > 40) {
				alert("Title is too long.");
				return false;
			}
			if (y.length > 500) {
				alert("Description is too long.");
				return false;
			}
			if (isNaN(v)){
				alert("Starting price is not valid.");
				return false;
			}
			else if (v <= 0){
				alert("Starting price is not valid.");
				return false;
			}
			if (isNaN(w)){
				alert("Sell now price is not valid.");
				return false;
			}
			else if (w <= 0){
				alert("Sell now price is not valid.");
				return false;
			}
		}
	</script>
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">BID ON THIS</a>
		  
		</div>
		<div class="navbar-collapse ">
			
			
		  <ul class="nav navbar-nav pull-right">
			<li class="active"><a href="index.php">HOME</a></li>
			<!-- Prikaz navigation bara za logirane korisnike i administratora -->
            <?php
            if (isset($_SESSION) === false) 
                session_start();
            
            if(isset($_SESSION['username'])){
				echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."newAuction.php".'"'.">" ."SELL"."</a></li>";
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."myProfile.php".'"'.">" .$_SESSION['username']."</a></li>";
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."logout.php".'"'.">" ."LOGOUT"."</a></li>";
            }
            else
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."signup.php".'"'.">" ."GUEST"."</a></li>";
            ?>
		  </ul>
		</div>
	  </div>
	</div>
	<br/>
	
	<!-- Header -->
    <div class="jumbotron">
      <div class="container">
        <h1 id="jumbo">&#8226; Add new auction &#8226;</h1>
      </div>
    </div>
	<!-- Prikaz forme za dodavanje aukcije -->
	<div class="container content text-center" style="padding-top:20px;">
		<form name="auctionForm" onsubmit="return validateAuctionForm()" action = "newAuctionInDb.php" method="post" enctype="multipart/form-data">
			<div class="col-md-6 col-md-offset-3 ">
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon">Title : </span>
						<input type="text" name="titleInput" class="form-control" required/>
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group" >
						<span class="input-group-addon">Description :</span>
						<input type="text" name="descriptionInput" class="form-control" required/>
					</div>
				</div>
				<!-- Iz baze dohvaćamo listu kategorija -->
				<?php 
					if (isset($_SESSION) === false) 
						session_start();

					try {
					$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
					}   
					catch( PDOException $e ) {
						echo "Greška: " . $e->getMessage(); exit();
					}
					$st = $db->query( "SELECT * FROM category" );
					echo "<div class=".'"'."form-group".'"'. "><div class=".'"'."input-group".'"'." >";
					echo "<span class=".'"'."input-group-addon".'"'.">Category :</span>";
					echo "<select class=".'"'."form-control".'"'." name=".'"'."categoryInput".'"'.">";
					foreach( $st->fetchAll() as $row ){
						$categoryName = $row['title'];
						echo "<option value=".'"'.$categoryName.'"'.">".$categoryName."</option>";
					}
					echo "</select></div></div>";
				  ?>

				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon">Starting price :</span>
						<input type="text" name="startingpriceInput" class="form-control" required />
						<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon">Buy now for :</span>
						<input type="text" name="sellnowInput" class="form-control" required />
						<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
					</div>
				</div>
				<div class="form-group">
					<label for="file_img">Image input (optional)</label>
					<input type="file" name="file_img">
				 </div>
				<button type="submit" name="btn_submit" class="btn btn-log " style="margin-bottom:20px" >SUBMIT</button>	
			</div>
		</form>
	</div>	

	<!-- Footer -->
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