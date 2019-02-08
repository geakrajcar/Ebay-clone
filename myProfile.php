<!-- Prikaz svojeg profila, na kojemu možemo mijenjati podatke i pregledavati aukcije koje bid-amo, koje smo bid-ali, koje smo kupili i koje prodajemo -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; Username</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
    <script>
		<!-- Validacija forme za izmjenu podataka trenutnog korisnika-->
		function validateForm(){
			var y = document.forms["myForm"]["passInput"].value;
			var v = document.forms["myForm"]["emailInput"].value;
			var w = document.forms["myForm"]["addrInput"].value;
			var q = document.forms["myForm"]["phoneInput"].value;
			if (y.length > 15 ) {
				alert("Password is too long.");
				return false;
			}
			if (v.length > 30){
				alert("E-mail is too long.");
				return false;
			}
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			if (re.test(v) == false){
				alert("E-mail input is not valid.");
				return false;
			}
			if (w.length > 50){
				alert("Address is too long.");
				return false;
			}
			if (q.length > 20){
				alert("Phone number is too long.");
				return false;
			}
			var isValid = /^[0-9+]*$/.test(q);
			if ( isValid == false ){
				alert("Phone number not correct.");
				return false;
			}
            return true;
			
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

	<!-- Header -->
    <div class="jumbotron" >
      <div class="container">
        <h1 id="jumbo">&#8226; MY PROFILE &#8226;</h1>
      </div>
    </div>
	
	<!-- Forma za prikaz i promjenu podataka ulogiranog korisnika-->
	<div class="container content text-center " style="padding-top:20px;">
	<?php 
		try {
				$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
		}   
		catch( PDOException $e ) {
				echo "Greška: " . $e->getMessage(); exit();
		}
		
		$usrname = isset($_SESSION['username']) ? $_SESSION['username'] : '';
		$st = $db->query( 'SELECT * FROM users WHERE username = '."'".$usrname."'" );
		$namesurname = "";
		$email="";
		$adr="";
		$phone="";
		foreach( $st->fetchAll() as $row )
		{
			$namesurname = $row['name'];
			$email= $row['email'];
			$adr= $row['address'];
			$phone= $row['phone'];
		}

		echo "<form name=".'"'."myForm".'"'." onsubmit=".'"'."return validateForm()".'"'." action =".'"'."mjenjanje.php".'"'." method=".'"'."post".'" '.">".
		"<div class=".'"'."col-md-6 col-md-offset-3 img-box ".'"'.">".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">". "<span class=".'"'."glyphicon glyphicon-user".'"'.">"."</span></span>".
		"<input type=".'"'."text".'"'." name=".'"'."nameInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$namesurname.'"'."disabled/>".
		"</div></div>".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">". "<span class=".'"'."glyphicon glyphicon-lock".'"'.">"."</span></span>".
		"<input type=".'"'."password".'"'." name=".'"'."passInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'."New password".'"'."/>".
		"</div></div>".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">"."<span class=".'"'."glyphicon glyphicon-envelope".'"'.">"."</span></span>".
		"<input type=".'"'."text".'"'." name=".'"'."emailInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$email.'"'."/>".
		"</div></div>".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">"."<span class=".'"'."glyphicon glyphicon-home".'"'.">"."</span></span>".
		"<input type=".'"'."text".'"'." name=".'"'."addrInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$adr.'"'."/>".
		"</div></div>".
		"<div class=".'"'."form-group".'"'.">".
		"<div class=".'"'."input-group".'"'.">".
		"<span class=".'"'."input-group-addon".'"'.">"."<span class=".'"'."glyphicon glyphicon-phone-alt".'"'.">"."</span></span>".
		"<input type=".'"'."text".'"'." name=".'"'."phoneInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$phone.'"'."/>".
		"</div></div>".
		"<button type=".'"'."submit".'"'." class=".'"'."btn btn-log".'"'." style=".'"'."margin-bottom:20px".'"'.">"."SAVE CHANGES"."</button>".
		"</div></form>";

		
	?>
	</div>
	
	<!-- Header -->
	<div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; MY CURRENT BIDS &#8226;</h1>
      </div>
    </div>

	<!-- Prikaz aukcija u kojem je trenutno najveca ponuda ulogiranog korisnika-->
	<div class="container content text-center ">
        <?php 
        $usr = $_SESSION['username'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM auctions WHERE currentBuyer = '."'".$usr."'" );
        foreach( $st->fetchAll() as $roww ){
             $codeofproduct = $roww['product'];
             $isactive      = $roww['active'];
             $currprice     = $roww['currentPrice'];
             $currbuy       = $roww['currentBuyer'];
             
             if($isactive == 1 && $currbuy != $_SESSION['username'] ) //prije nego itko da ponudu, current buyer je user koji je postavio aukciju             
             {   
                 $dt = $db->query( 'SELECT * FROM products WHERE code = '."'".$codeofproduct."'" );
                 
                 foreach( $dt->fetchAll() as $row ){
                     $image = "img/".$row[ 'category' ].".png";
                     if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
                        $image = $row['imgPath'];
                        
                     echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
                     .'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
                     "<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
                     "<hr><p>".$row['description']."</p>".
                     "<table class=".'"'."table".'"'."><tbody><tr>".
                     "<td><h3>".$row[ 'category' ]."</h3></td>".
                     "<td><h3>"."My bid: ". $currprice  ."&#8364;</h3>".
                     "<td><h3>"."Buy now: " .$row[ 'sellNow' ] ."&#8364;</h3>".
                     "</tr></tbody></table></div></div>.
                     ";
                     }
                 }
        }
        ?>
	</div>
	
	<!-- Header -->
	<div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; BOUGHT ITEMS &#8226;</h1>
      </div>
    </div>
	
	<!-- Proizvodi koje je korisnik kupio -->
	<div class="container content text-center ">
        <?php 
        $usr = $_SESSION['username'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM auctions WHERE currentBuyer = '."'".$usr."'" );
        foreach( $st->fetchAll() as $roww ){
             $codeofproduct = $roww['product'];
             $isactive      = $roww['active'];
             $currprice     = $roww['currentPrice'];
             
             if($isactive == 0){
                 $dt = $db->query( 'SELECT * FROM products WHERE code = '."'".$codeofproduct."'" );
                 
                 foreach( $dt->fetchAll() as $row ){
                    $image = "img/".$row[ 'category' ].".png";
                    if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
                        $image = $row['imgPath'];
                        
                     echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
                     .'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
                     "<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
                     "<hr><p>".$row['description']."</p>".
                     "<table class=".'"'."table".'"'."><tbody><tr>".
                     "<td><h3>".$row[ 'category' ]."</h3></td>".
                     "<td><h3>"."Price paid: ". $currprice  ."&#8364;</h3>".
                     "<td><h3>"."Buy it now price: " .$row[ 'sellNow' ] ."&#8364;</h3>".
                     "</tr></tbody></table></div></div>.
                     ";
                     }
                 }
        }
        ?>
	</div>
	
	<!-- Header -->
	<div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; WHAT I SELL &#8226;</h1>
      </div>
    </div>
    <!-- Proizvodi koje trenutno ulogiran korisnik prodaje-->
	<div class="container content text-center ">
        <?php 
        $usr = $_SESSION['username'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM products WHERE seller = '."'".$usr."'" );
        $link = "modifyAuctionInDb.php";
        
        $_SESSION['changeactivity'] = 1;
        foreach( $st->fetchAll() as $row ){
             $image  = "img/".$row[ 'category' ].".png";
             $prodid = $row['code'];
             $_SESSION['code'] = $row['code'];
             $nt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$prodid."'" );
             $currprice = "";
             $isactive  = 1;
             
             foreach( $nt->fetchAll() as $roww ){
                 $currprice = $roww['currentPrice'];
                 $isactive  = $roww['active'];
                 
             }
             if($isactive==1){
                 if($row['imgPath'] != "") 
                    $image = $row['imgPath'];
                    
                 echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
                 .'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
                 "<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
                 "<hr><p>".$row['description']."</p>".
                 "<table class=".'"'."table".'"'."><tbody><tr>".
                 "<td><h3>"."Starting price: ". $row[ 'startingPrice' ] ."&#8364;</h3></td>".
                 "<td><h3>"."Buy now: " .$row[ 'sellNow' ] ."&#8364;</h3></td>".
                 "<td><h3>"."Highest bid:". $currprice ."&#8364;</h3> "."<a href=".'"'.$link.'"'." class=".'"'."btn btn-log".'"'. " style=".'"'."margin-bottom:20px".'"'.">ACCEPT OFFER</a></td>".
                 "</tr></tbody></table></div></div>.
                 ";
                 }
        }
        ?>
	</div>
	
	<!-- Header -->
    <div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; WHAT I'VE SOLD &#8226;</h1>
      </div>
    </div>
    <!-- Proizvodi koje je trenutno ulogiran korisnik prodao-->
	<div class="container content text-center ">
        <?php 
        $usr = $_SESSION['username'];
        try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
        }   
        catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
        }
        $st = $db->query( 'SELECT * FROM products WHERE seller = '."'".$usr."'" );

        foreach( $st->fetchAll() as $row ){
             $image  = "img/".$row[ 'category' ].".png";
             $prodid = $row['code'];
             $_SESSION['code'] = $row['code'];
             $nt = $db->query( 'SELECT * FROM auctions WHERE product = '."'".$prodid."'" );
             $currprice = "";
             $isactive  = 1;
             foreach( $nt->fetchAll() as $roww ){
                 $currprice = $roww['currentPrice'];
                 $isactive  = $roww['active'];   
             }
             if($isactive == 0){
                 if($row['imgPath'] != "")  //ako je path zadan, postoji slika proizvoda. Inace je slika od kategorije.
                    $image = $row['imgPath'];
                 echo "<div class=".'"'."col-sm-10 col-sm-offset-1 img-box".'"'.">"."<div class=".'"'."col-sm-3 img-box".'"' ." style=".'"'."margin-right:10px;"
                 .'"'.">"."<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>"."</div><div >".
                 "<a><h2 class=".'"'. "intro-text-l".'"'." >".$row[ 'title' ]."</h2></a>".
                 "<hr><p>".$row['description']."</p>".
                 "<table class=".'"'."table".'"'."><tbody><tr>".
                 "<td><h3>"."Starting price: ". $row[ 'startingPrice' ] ."&#8364;</h3>".
                 "<td><h3>"."Buy now: " .$row[ 'sellNow' ] ."&#8364;</h3>".
                 "<td><h3>"."Final price: " .$currprice ."&#8364;</h3>".
                 "</tr></tbody></table></div></div>.
                 ";
             }
        }
        ?>
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