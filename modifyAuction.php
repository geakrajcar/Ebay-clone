<!-- Modifikacija aukcija od strane administratora -->
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
		<!-- Funkcija za validaciju forme na izmjenu aukcije -->
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
			else if (v < 0){
				alert("Starting price is not valid.");
				return false;
			}
			if (isNaN(w)){
				alert("Sell now price is not valid.");
				return false;
			}
			else if (w < 0){
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
			<!-- Prikaz navigation bara za logirane korisnike i adinistratora  -->
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
	<br/>
	<!-- Header -->
    <div class="jumbotron">
		<div class="container">
			<h1 id="jumbo">&#8226; Modify auction &#8226;</h1>
		</div>
    </div>
	
	<div class="container content text-center" style="padding-top:20px;">
	<!-- Dohvaćanje aukcije koju izmjenjujemo iz baze -->
    <?php 
    
    try {
            $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=lgaspar;charset=utf8', 'student', 'pass.mysql');
    }   
    catch( PDOException $e ) {
            echo "Greška: " . $e->getMessage(); exit();
    }
    
    $usrname = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $st = $db->query( 'SELECT * FROM products WHERE code = '."'".$_GET['code']."'" );
    $title         = "";
    $description   = "";
    $category      = "";
    $startingprice = "";
    $sellnow       = "";
    $imgpath       = "";
    $seller        = "";
    $code          = "";
    foreach( $st->fetchAll() as $row )
    {
        $title         = $row['title'];
        $description   = $row['description'];
        $category      = $row['category'];
        $startingprice = $row['startingPrice'];
        $sellnow       = $row['sellNow'];
        $imgpath       = $row['imgPath'];
        $seller        = $row['seller'];
        $code          = $row['code'];
        $imagepath     = $row['imgPath'];
    }
	//ako nema sliku, postavi sliku od kategorije
    if($imagepath == "") 
        $image = "img/".$category.".png";
	//ako je logiran administrator, prikažemo mu formu za modifikaciju aukcije
    if($_SESSION['admin'] == 1 ){
        $_SESSION['changeactivity'] = 0;
        $_SESSION['code'] = $_GET['code'];
        $_SESSION['delete'] = 0;
        echo"<div class=".'"'."container-fluid content text-center ".'"'." style=".'"'."padding-top:20px".'"'.">".
		"<div class=".'"'."col-md-6 col-md-offset-3 img-box".'"'.">".
		"<form name =".'"'."auctionForm".'"'." onsubmit=".'"'."return validateAuctionForm()".'"'." action =".'"'."modifyAuctionInDb.php".'"'. " method=".'"'."post".'" '
        ." enctype=".'"'."multipart/form-data".'"'.">".
        "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<img class=".'"'."img-thumbnail ".'"'." src=".'"'.$image.'"' ."/>".
        "</div></div>".
        "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<span class=".'"'."input-group-addon".'"'.">"."Title"."</span>".
        "<input type=".'"'."text".'"'." name=".'"'."titleInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$title.'"'."/>".
        "</div></div>".
        "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<span class=".'"'."input-group-addon".'"'.">"."Description"."</span>".
        "<input type=".'"'."text".'"'." name=".'"'."descriptionInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$description.'"'."/>".
        "</div></div>";
        
        $ct = $db->query( "SELECT * FROM category" );
        echo "<div class=".'"'."form-group".'"'. "><div class=".'"'."input-group".'"'." >";
        echo "<span class=".'"'."input-group-addon".'"'.">Category :</span>";
        echo "<select class=".'"'."form-control".'"'." name=".'"'."categoryInput".'"'.">";
        foreach( $ct->fetchAll() as $row ){
                $categoryName = $row['title'];
                echo "<option value=".'"'.$categoryName.'"'.">".$categoryName."</option>";
        }
        echo "</select></div></div>";

        echo "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<span class=".'"'."input-group-addon".'"'.">"."Starting price"."</span>".
        "<input type=".'"'."text".'"'." name=".'"'."startingpriceInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$startingprice.'"'."disabled/>".
		"<span class=".'"'."input-group-addon".'"'."><span class=".'"'."glyphicon glyphicon-euro".'"'."></span></span>".
        "</div></div>".
        "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<span class=".'"'."input-group-addon".'"'.">"."Sell now"."</span>".
        "<input type=".'"'."text".'"'." name=".'"'."sellnowInput".'"'." class=".'"'."form-control".'"'." placeholder=".'"'.$sellnow.'"'."disabled/>".
		"<span class=".'"'."input-group-addon".'"'."><span class=".'"'."glyphicon glyphicon-euro".'"'."></span></span>".
        "</div></div>".
         "<div class=".'"'."form-group".'"'.">".
        "<div class=".'"'."input-group".'"'.">".
        "<label for=".'"'."file_img".'"'.">New image for product</label>
         <input type=".'"'."file".'"'." name=".'"'."file_img".'"'.">".
        "</div></div>".
        "<button type=".'"'."submit".'"'." class=".'"'."btn btn-log".'"'." style=".'"'."margin-bottom:20px".'"'.">"."SAVE CHANGES"."</button>".
        "</form></div></div>";
    }
    else{
        echo "You're not authorised to change this entry!";
    }
	
?>
	</div>
	
<!-- Header -->
	<div class="jumbotron">
		<div class="container">
			<h1 id="jumbo">&#8226; Or delete it... &#8226;</h1>
		</div>
    </div>
	<div class="container content text-center ">
    <?php 
        $_SESSION['delete'] = 1;
        echo "<form name =".'"'."deleteEntry".'"'." action =".'"'."modifyAuctionInDb.php".'"'. " method=".'"'."post".'" '.">".
        "<button type=".'"'."submit".'"'." class=".'"'."btn btn-log".'"'." style=".'"'."margin-bottom:20px".'"'.">"."DELETE ENTRY"."</button>".
        "</form>"; //uklonila sam /div ispred /form

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