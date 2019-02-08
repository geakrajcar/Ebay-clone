<!-- Stranica na kojoj logirani korisnici nude novi bid za aukcije -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; Bid now</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
	<script>
	function validateForm(){
			var x = document.forms["myForm"]["newBid"].value;
			if  (x <= 0) {
				alert("New bid price not valid");
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

			<ul class="nav navbar-nav pull-right">
				<li class="active"><a href="index.php">HOME</a></li>
				<!-- Prikaz navigation bara za logirane korisnike -->
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
	<br/>
	
	<!-- Dio za davanje nove ponude (bid-a) -->
    <div class="jumbotron">
		<div class="container">
			<h1 id="jumbo">&#8226; Bidding for product &#8226;</h1>
		</div>
    </div>
	<div class="container content text-center" style="padding-top:20px;">
		<!-- Dohvaćanje odabrane aukcije iz baze -->
        <?php 
        $code = $_GET['code'];
        $_SESSION['code'] = $_GET['code'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM products WHERE code = '."'".$code."'" );
        $nt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$code."'" );
        $currprice = "";
        foreach( $nt->fetchAll() as $roww ){
            $currprice = $roww['currentPrice'];
        }
        foreach( $st->fetchAll() as $row ){
			$image = "img/".$row[ 'category' ].".png";
			echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
			.'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
			"<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
			"<hr><p>".$row['description']."</p>".
			"<table class=".'"'."table".'"'."><tbody><tr>".
			"<td><h3>".$row[ 'category' ]."</h3></td>".
			"<td><h3>"."Auction(current): " .$currprice ."&#8364;</h3>".
			"<td><h3>"."Buy now: " .$row[ 'sellNow' ] ."&#8364;</h3>".
			"</tr></tbody></table></div></div>.
			";
        }
        ?>
	</div>
	<!-- Forma za unošenje nove ponude na aukciji -->
    <div class="container content text-center" style="padding-top:20px">
		<form name= "myForm" onsubmit="return validateForm()" action="dodajnovibid.php" method="post">
			<div class="col-md-6 col-md-offset-3 img-box ">
				<div class="form-group ">
					<div class="input-group " style="width:220px;">
						<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
						<input type="text" name="newBid" class="form-control " placeholder="amount" required/>	
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-log " style="margin-bottom:20px">SUBMIT</button>
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