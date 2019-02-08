<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; Admin</title> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
	<script>
    <!-- Validacija forme za unos novog korisnika-->
	function validateForm(){
		var x = document.forms["myForm"]["userInput"].value;
		var y = document.forms["myForm"]["passInput"].value;
		var z = document.forms["myForm"]["nmsurnm"].value;
		var v = document.forms["myForm"]["emailInput"].value;
		var w = document.forms["myForm"]["addrInput"].value;
		var q = document.forms["myForm"]["phoneInput"].value;
		if  (x.length > 15) {
			alert("Username is too long.");
			return false;
		}
		if (y.length > 15) {
			alert("Password is too long.");
			return false;
		}
		if (z.length > 50){
			alert("Name is too long.");
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
	}
    <!-- Validacija forme za unos kategorije-->
	function validateCatForm(){
		var x = document.forms["catForm"]["newCategory"].value;
		if (x.length > 25){
			alert("Category name is too long.");
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
	
	<div class="container content text-center" style="padding-top:20px;">
		<h1> Hello Admin!</h1>
	</div>
	
    <!-- Forma za dodavanje novog korisnika-->
	<div class="jumbotron" style="margin-top:5px; margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; ADD NEW USER &#8226;</h1>
      </div>
    </div>
	<div class="container content text-center" style="padding-top:20px;">
    <form name="myForm" onsubmit="return validateForm()" action = "dodavanje.php" method="post">
			<div class="col-md-6 col-md-offset-3 ">
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" name="userInput" class="form-control" placeholder="Username" required/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="password" name="passInput" class="form-control" placeholder="Password" required/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" name="nmsurnm" class="form-control" placeholder="Name and Surname" required/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					<input type="email" name="emailInput" class="form-control" placeholder="E-mail" required/>
				</div>
			</div>
			<div class="form-group ">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
					<input type="text" name="addrInput" class="form-control" placeholder="Address" required/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
					<input type="tel" name="phoneInput" class="form-control" placeholder="Mobile number" required/>
				</div>
			</div>
			<button type="submit" class="btn btn-log " style="margin-bottom:20px">ADD USER</button>	
			</div>
		</form>
	</div>
	<!-- Forma za dodavanje nove kategorije-->
	<div class="jumbotron" style="margin-bottom:40px;" >
      <div class="container">
        <h3 id="jumbo">&#8226; ADD NEW CATEGORY &#8226;</h1>
      </div>
    </div>
	
	<div class="container content text-center" style="padding-top:20px;">
	<div class="col-md-6 col-md-offset-3 ">
		<form action = "dodavanje.php" method = "post" enctype="multipart/form-data">	
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-list"></span></span>
					<input type="text" name="newCategory" class="form-control" placeholder="New category" required/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
                    <label for="file_img">Image for category</label>
                    <input type="file" name="file_img" required>
				</div>
			</div>
			<button type="submit" name="btn_submit" class="btn btn-log " style="margin-bottom:20px">ADD CATEGORY</button>	
		</form>
	</div>
	</div>
	
	<!--Footer-->
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