<!-- Stranica za dodavanje novih korisnika i/ili LOG IN -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BID ON THIS &#8226; SignUp</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:300&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
    
    <script>
	<!-- Validacije formi za login ili signup-->
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
	function validateSignUp(){
		var x = document.forms["signUpForm"]["userInput"].value;
		var y = document.forms["signUpForm"]["passInput"].value;
		var z = document.forms["signUpForm"]["nmsurnm"].value;
		var v = document.forms["signUpForm"]["emailInput"].value;
		var w = document.forms["signUpForm"]["addrInput"].value;
		var q = document.forms["signUpForm"]["phoneInput"].value;
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
	</script>
</head>
<body>	
	<br/>
    <div class="jumbotron">
      <div class="container">
        <h1 id="jumbo">BID ON THIS &#8226; Let's get it started!</h1>
      </div>
    </div>
	<!-- Forme za sign up i log in -->
	<div class="container content text-center" style="padding-top:20px;">
		<div class="col-md-5 col-md-offset-2 ">
			<form name="signUpForm" onsubmit="return validateSignUp()" action="dodavanje.php" method="post">
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="userInput" class="form-control" placeholder="Username" required />
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" name="passInput" class="form-control" placeholder="Password" required />
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="nmsurnm" class="form-control" placeholder="Name and Surname" required />
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
						<input type="email" name="emailInput" class="form-control" placeholder="E-mail" required />
					</div>
				</div>
				<div class="form-group ">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
						<input type="text" name="addrInput" class="form-control" placeholder="Address" required />
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
						<input type="tel" name="phoneInput" class="form-control" placeholder="Mobile number" required />
					</div>
				</div>
				<button type="submit" class="btn btn-log " style="margin-bottom:20px">SIGN UP!</button>	   
			</form>
        </div>
		<div class="col-md-3 box" style="padding-top:30px; padding-bottom:30px; ">
				<p> You already have an account? </p>
				<br>
				<h4 class="intro-text-l">SIGN IN</h4>
				<hr>
				<div class="container-fluid content text-center" style="padding-top:20px">
					<form name="myForm" action="loginiranje.php" onsubmit="return validateForm()" method="post">
						<div class="form-group ">
							<div class="input-group " style="width:220px;">
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" name="uname" class="form-control " placeholder="Username"/>	
							</div>
						</div>
						<div class="form-group">
							<div class="input-group " style="width:220px">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" name="passw" class="form-control " placeholder="Password"/>
							</div>
						</div>
						<button type="submit" class="btn btn-log ">LOG IN</button>						
					</form>
				</div>
		</div>
	</div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    
</body>
</html>