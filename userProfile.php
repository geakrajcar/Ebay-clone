<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; Username</title> <!-- Zamijeniti nazivom kategorije -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
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
	
	
	<?php 
	if (isset($_SESSION) === false) 
                session_start();
	
	if (isset($_SESSION['username']) === false){
    session_unset(); 
    session_destroy();
	echo "<div class=".'"'."container-fluid content text-center".'"'." style=".'"'."padding-top:20px".'"'.">".
    "<form name=".'"'."myForm".'"'." action =".'"'."loginiranje.php".'"'. " method=".'"'."post".'" '." onsubmit=".'"'."return validateForm()".'"'."class =".'"'."form-inline".'"'.">".
    "<div class=".'"'."form-group".'"'.">".
    "<div class=".'"'."input-group".'"'." style=".'"'."width:220px;".'"'.">".
    "<span class=".'"'."input-group-addon".'"'.">". "<span class=".'"'."glyphicon glyphicon-user".'"'.">"."</span></span>".
    "<input type=".'"'."text".'"'." name=".'"'."uname".'"'." class=".'"'."form-control".'"'." placeholder=".'"'."Username".'"'." />".
    "</div></div>"."<div class=".'"'."form-group".'"'.">".
    "<div class=".'"'."input-group".'"'." style=".'"'."width:220px".'"'.">".
    "<span class=".'"'."input-group-addon".'"'.">"."<span class=".'"'."glyphicon glyphicon-lock".'"'.">"."</span></span>".
    "<input type=".'"'."password".'"'." name=".'"'."passw".'"'." class=".'"'."form-control".'"'." placeholder=".'"'."Password".'"'." />".
    "</div></div>"."<button type=".'"'."submit".'"'." class=".'"'."btn btn-log".'"'.">"."LOG IN"."</button>".
    "<a href=".'"'."signup.php".'"'." class=".'"'."btn btn-log".'"'." role=".'"'."button".'"'.">"."SIGN UP"."</a>".
    "</form>"."</div>";

	}
?>

    <div class="jumbotron" >
      <div class="container">
        <h1 id="jumbo">&#8226; USERNAME's PROFILE &#8226;</h1>
      </div>
    </div>
<div class="container content text-center " style="padding-top:20px;">
		<form>
			<div class="col-md-6 col-md-offset-3 img-box ">
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" name="nameInput" class="form-control" placeholder="Name and Surname"/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					<input type="email" name="emailInput" class="form-control" placeholder="E-mail"/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
					<input type="text" name="addrInput" class="form-control" placeholder="Address"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
					<input type="tel" name="phoneInput" class="form-control" placeholder="Mobile number"/>
				</div>
			</div>	
			</div>
		</form>
	</div>
	
	<div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; WHAT I SELL &#8226;</h1>
      </div>
    </div>
<div class="container content text-center ">
		<div class="col-sm-10 col-sm-offset-1 img-box">
			<div class="col-sm-3 img-box" style="margin-right:10px;">
				<img class="img-thumbnail " src="img/fashion.png" />
			</div>
			<div >
				<a><h2 class="intro-text-l" >Dress n.1</h2></a>
						<hr>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac nisi et turpis porta vestibulum et non eros. Nulla sed fermentum dui, vel volutpat turpis. Nam velit urna, egestas ut mauris non, vehicula convallis eros. Sed fringilla, nulla non ultrices imperdiet, est justo porta felis, et imperdiet enim lectus eget lacus. Nullam sed nisl ultricies, tempus neque volutpat, scelerisque est. Curabitur imperdiet elit eget convallis sodales. Fusce elementum purus ex, eu dignissim nunc pulvinar nec. Nam semper et ante et tincidunt. Ut hendrerit diam erat, vel tristique erat dapibus quis. Donec congue pellentesque sapien quis imperdiet. </p>
					
				<table class="table">
					<tbody>
					  <tr>
					  <!-- Pritiskom na button provjeriti je li korisnik logiran - inače ga odvesti na stranicu za logiranje -->
						<td><h3>USERNAME</h3></td> <!--seller-->
						<td><h3>40 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">BID ON THIS</button></td>
						<td><h3>125 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">Buy it NOW</button></td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>
		<div class="col-sm-10 col-sm-offset-1 img-box">
			<div class="col-sm-3 img-box" style="margin-right:10px;">
				<img class="img-thumbnail " src="img/fashion.png" />
			</div>
			<div >
				<a><h2 class="intro-text-l" >Dress n.2</h2></a>
						<hr>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac nisi et turpis porta vestibulum et non eros. Nulla sed fermentum dui, vel volutpat turpis. Nam velit urna, egestas ut mauris non, vehicula convallis eros. Sed fringilla, nulla non ultrices imperdiet, est justo porta felis, et imperdiet enim lectus eget lacus. Nullam sed nisl ultricies, tempus neque volutpat, scelerisque est. Curabitur imperdiet elit eget convallis sodales. Fusce elementum purus ex, eu dignissim nunc pulvinar nec. Nam semper et ante et tincidunt. Ut hendrerit diam erat, vel tristique erat dapibus quis. Donec congue pellentesque sapien quis imperdiet. </p>
					
				<table class="table">
					<tbody>
					  <tr>
						<td><h3>USERNAME</h3></td> <!--seller-->
						<td><h3>40 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">BID ON THIS</button></td>
						<td><h3>125 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">Buy it NOW</button></td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>    
		<div class="col-sm-10 col-sm-offset-1 img-box">
			<div class="col-sm-3 img-box" style="margin-right:10px;">
				<img class="img-thumbnail " src="img/fashion.png" />
			</div>
			<div >
				<a><h2 class="intro-text-l" >Dress n.3</h2></a>
						<hr>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac nisi et turpis porta vestibulum et non eros. Nulla sed fermentum dui, vel volutpat turpis. Nam velit urna, egestas ut mauris non, vehicula convallis eros. Sed fringilla, nulla non ultrices imperdiet, est justo porta felis, et imperdiet enim lectus eget lacus. Nullam sed nisl ultricies, tempus neque volutpat, scelerisque est. Curabitur imperdiet elit eget convallis sodales. Fusce elementum purus ex, eu dignissim nunc pulvinar nec. Nam semper et ante et tincidunt. Ut hendrerit diam erat, vel tristique erat dapibus quis. Donec congue pellentesque sapien quis imperdiet. </p>
					
				<table class="table">
					<tbody>
					  <tr>
					  <!-- Pritiskom na button provjeriti je li korisnik logiran - inače ga odvesti na stranicu za logiranje -->
						<td><h3>USERNAME</h3></td> <!--seller-->
						<td><h3>40 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">BID ON THIS</button></td>
						<td><h3>125 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">Buy it NOW</button></td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>
		<div class="col-sm-10 col-sm-offset-1 img-box">
			<div class="col-sm-3 img-box" style="margin-right:10px;">
				<img class="img-thumbnail " src="img/fashion.png" />
			</div>
			<div >
				<a><h2 class="intro-text-l" >Dress n.4</h2></a>
						<hr>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
					
				<table class="table">
					<tbody>
					  <tr>
						<td><h3>USERNAME</h3></td> <!--seller-->
						<td><h3>40 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">BID ON THIS</button></td>
						<td><h3>125 &#8364;</h3> <button type="submit" class="btn btn-log " style="margin-bottom:20px">Buy it NOW</button></td>
					  </tr>
					</tbody>
				  </table>
			</div>
		</div>        
	

	
	<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
                <ul class=" navbar-btn list-inline pull-right">
                    <li><img class="img-responsive" width="30" height="30" src="img/fb.svg"/></span></li>
                    <li><img class="img-responsive" width="30" height="30" src="img/ins.svg"/></span></li>
                </ul>
            <p class="navbar-text pull-left">Made by Leonora & Gea</p>
        </div>
    </div>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>