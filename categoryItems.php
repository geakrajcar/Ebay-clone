<!-- Pregled proizvoda po kategorijama za logirane korisnike i goste -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Spajanje na bazu, prikaz odabrane kategorije u naslovu -->
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
            foreach( $st->fetchAll() as $row ){
                $nametemp = $row['title']."_x";
                if( isset($_POST[$nametemp]))
                    $_SESSION['category'] = $row['title'];
            }

        $cat = strtoupper($_SESSION['category']);
        echo "<title>BID ON THIS &#8226;". $cat."</title> ";
       ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
    
    <!-- Validacija forme za login -->
    <script>
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

	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">BID ON THIS</a>
			</div>
			<div class="navbar-collapse ">	
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="index.php">HOME</a></li>
					<!-- Prikaz navigation bara za logirane korisnike ili admina -->
					<?php
					if (isset($_SESSION) === false) 
						session_start();
					
					if(isset($_SESSION['username'])){
						if($_SESSION['admin']==1)
							$link = "adminProfile.php";
						else
							$link = "myProfile.php";
						echo "<li class=".'"'."active".'"'.">". "<a href=".'"'."newAuction.php".'"'.">" ."SELL"."</a></li>";
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
	
	
	<!-- Forma za login, vidljiva ako nitko nije ulogiran -->
	<?php 
		if (isset($_SESSION) === false) 
					session_start();
		
		if (isset($_SESSION['username']) === false){
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
	
	<!-- Header s nazivom kategorije koju pregledavamo -->
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
	
    <!-- Dropdown meniji za sortiranje proizvoda -->
	<div class="container content text-center ">
        <form method = "post" action = "categoryItems.php">
            Sort items by: 
            <select name="sort">
                <option value="title">title</option>
                <option value="sellNow">buy now price</option>
                <option value="startingPrice">starting price</option>
                </select>
            <select name="ascdesc">
                <option value="ASC">ascending</option>
                <option value="DESC">descending</option>
                </select>
             <br><br>
            <input type="submit" value="Apply!">
            </form>       
    </div>
	
	<!-- Ispis proizvoda odabrane  kategorije-->
	<div class="container content text-center ">
        <?php 
        $cat = $_SESSION['category'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $criteria = "title";
        $ascdesc  = "ASC";
        if (isset($_POST['sort']) && isset($_POST['ascdesc']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
             $criteria = $_POST['sort'];
             $ascdesc =  $_POST['ascdesc'];
         }
        $st = $db->query( 'SELECT * FROM products WHERE category = '."'".$cat."' ORDER BY ". $criteria." ".$ascdesc );
        foreach( $st->fetchAll() as $row ){
			$prodid = $row['code'];
			$proseller = $row['seller']; //prilikom ispisa gledam ispisujem li svoju aukciju --> drugaciji je ispis!
			$active = 1;    
			$nt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$prodid."'" );
			$currprice = "";
			foreach( $nt->fetchAll() as $roww ){
				$active = $roww['active'];
				$currprice = $roww['currentPrice'];
			}
			//ispisujem samo proizvode cija je aukcija aktivna
			if ($active== 1){
				if (isset($_SESSION['username']) == true){
					if ($_SESSION['username'] == $proseller){
						$image = "img/".$cat.".png";
				 
						if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
							$image = $row['imgPath'];
						 
						echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
							.'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
							"<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
							"<hr><p>".$row['description']."</p>".
							"<table class=".'"'."table".'"'."><tbody><tr>".
							"<td><h3>".$row[ 'seller' ]."</h3></td>".
							"<td><h3>"."Starting price: ". $row[ 'startingPrice' ] ."&#8364;</h3></td>".
							"<td><h3>"."Buy now: " .$row[ 'sellNow' ] ."&#8364;</h3></td>".
							"<td><h3>"."Highest bid:". $currprice ."&#8364;</h3> "."</td>".
							"</tr></tbody></table></div></div>.
							";
					}
					else if ($_SESSION['username'] != $proseller){
						$image = "img/".$cat.".png";
				 
						if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
							$image = $row['imgPath'];
						 
						if(isset($_SESSION['username']) && $_SESSION['username'] !=""){
							$link  = "bidding.php"."?code=".$row['code'];
							$drugi = "buynow.php"."?code=".$row['code'];
						}
						else{
							$link  = "signup.php";
							$drugi = "signup.php";
						}
						echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
							.'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
							"<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
							"<hr><p>".$row['description']."</p>".
							"<table class=".'"'."table".'"'."><tbody><tr>".
							"<td><h3>".$row[ 'seller' ]."</h3></td>".
							"<td><h3>".$currprice ."&#8364;</h3> "."<a href=".'"'.$link.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">BID ON THIS</a></td>".
							"<td><h3>".$row[ 'sellNow' ] ."&#8364;</h3> "."<a href=".'"'.$drugi.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">Buy it now</a></td>".
							"</tr></tbody></table></div></div>.
							";
					}
				}
				else if ($myAuction == false){
					$image = "img/".$cat.".png";
				 
					if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
						$image = $row['imgPath'];
					 
					if(isset($_SESSION['username']) && $_SESSION['username'] !=""){
						$link  = "bidding.php"."?code=".$row['code'];
						$drugi = "buynow.php"."?code=".$row['code'];
					}
					else{
						$link  = "signup.php";
						$drugi = "signup.php";
					}
					echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
						.'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
						"<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
						"<hr><p>".$row['description']."</p>".
						"<table class=".'"'."table".'"'."><tbody><tr>".
						"<td><h3>".$row[ 'seller' ]."</h3></td>".
						"<td><h3>".$currprice ."&#8364;</h3> "."<a href=".'"'.$link.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">BID ON THIS</a></td>".
						"<td><h3>".$row[ 'sellNow' ] ."&#8364;</h3> "."<a href=".'"'.$drugi.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">Buy it now</a></td>".
						"</tr></tbody></table></div></div>.
						";
				}
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