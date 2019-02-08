<!-- Prikaz aukcija po kategorijama za admina  -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
		if (isset($_SESSION) === false) 
			session_start();
		//Spajanje na bazu
		try {
		$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
		}   
		catch( PDOException $e ) {
			echo "Greška: " . $e->getMessage(); exit();
		}
		//Dohvaćamo naziv odabrane kategorije, jer nam se isti javlja u naslovu stranice.
		$st = $db->query( "SELECT * FROM category" );
		foreach( $st->fetchAll() as $row ){
			$nametemp = $row['title']."_x";
			if( isset($_POST[$nametemp]))
				$_SESSION['category'] = $row['title'];
		}
        $cat = strtoupper($_SESSION['category']);
        //Naslov
        echo "<title>BID ON THIS &#8226;". $cat."</title> ";
       ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
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
            <!-- Navigation bar prilagođen logiranom administratoru -->
			<?php
            if (isset($_SESSION) === false) 
                session_start();
            
            if(isset($_SESSION['username'])){
                if($_SESSION['admin']==1)
                    $link = "adminProfile.php";
                else
                    $link = "myProfile.php";
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'.$link.'"'.">" .$_SESSION['username']."</a></li>";
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."logout.php".'"'.">" ."LOGOUT"."</a></li>";
            }
            else
                echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."signup.php".'"'.">" ."GUEST"."</a></li>";
            ?>
		  </ul>
		</div>
	  </div>
	</div>
	
	<!--header s nazivom kategorije koju pregledavamo-->
    <div class="jumbotron" >
      <div class="container">
        <?php 
            if (isset($_SESSION) === false) 
                session_start();

        $cat = strtoupper($_SESSION['category']);
        echo "<h1 id=".'"'."jumbo".'"'.">"."&#8226; ".$cat." &#8226;</h1>";
       ?>
      </div>
    </div>
	<!-- Ispis proizvoda zadane kategorije-->
    <!-- Prikaz je prilagođen administratoru, on ne bid-a i ne kupuje, već samo pregledava trenutno stanje aukcije ili modificira(button modify)-->
	<div class="container content text-center ">
        <?php 
        $cat = $_SESSION['category'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM products WHERE category = '."'".$cat."'" );
        foreach( $st->fetchAll() as $row ){
			$prodid = $row['code'];
			$active = 1;
			$nt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$prodid."'" );
			
			foreach( $nt->fetchAll() as $roww ){
				$active = $roww['active'];
			}
			//Ispisujemo samo proizvode cija je aukcija aktivna
			if($active == 1){    
				$image = "img/".$cat.".png";
				//Ako je path zadan, postoji slika proizvoda. Inace koristimo sliku kategorije.
				if($row['imgPath'] != "")  
					$image = $row['imgPath'];
				
				$link = "modifyAuction.php"."?code=".$row['code'];
				echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
				.'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
				"<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
				"<hr><p>".$row['description']."</p>".
				"<table class=".'"'."table".'"'."><tbody><tr>".
				"<td><h3>".$row[ 'seller' ]."</h3></td>".
				"<td><h3>"."Starting price: ".$row[ 'startingPrice' ] ."&#8364;</h3> </td>".
				"<td><h3>"."Sell now price: ". $row[ 'sellNow' ] ."&#8364;</h3> </td>".
				"<td>"."<a href=".'"'.$link.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">MODIFY</a></td>".
				"</tr></tbody></table></div></div>.
				";
			}
        }
        ?>
		
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