<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #d47677;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>
<body>
<div class="signup-form">
    <form  method="post" enctype="multipart/form-data">
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
			<div class="row">
				<div class="col">
					<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" >
					<span id="first_name_error"  class=" pull-left" style="color:red;"></span>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" >
					<span id="last_name_error"  class=" pull-left" style="color:red;"></span>
				</div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" >
			<span id="email_error"  class=" pull-left" style="color:red;"></span>
        </div>
		<div class="form-group">
        	<input type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" >
			<span id="phone_no_error"  class=" pull-left" style="color:red;"></span>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
			<span id="pass_error"  class=" pull-left" style="color:red;"></span>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" >
			<span id="c_pass_error"  class=" pull-left" style="color:red;"></span>
        </div>        
        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" > I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick='add_user()'>Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="<?= WEBBASEPATH ?>login">Sign in</a></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function(){
		$('#first_name').keyup(function (e) {
				$(this).val($(this).val().replace(/^\s+/g, ''));
			});
	});
	$(document).ready(function(){
		$('#last_name').keyup(function (e) {
				$(this).val($(this).val().replace(/^\s+/g, ''));
			});
	});

	function add_user(){
		var first_name = $("#first_name").val();
		var last_name = $("#last_name").val();
		var phone_no = $("#phone_no").val();
		var email = $("#email").val();
		var password = $("#password").val();
		var c_password = $("#confirm_password").val();
		var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var hasError = 0;
            
        
		if(first_name.length == 0){
			document.getElementById('first_name_error').innerHTML = "Enter Your First Name";
			return false;
		}else{
			document.getElementById('first_name_error').innerHTML = "";
		}
		if(last_name.length == 0){
			document.getElementById('last_name_error').innerHTML = "Enter Your Last Name";
			return false;
		}else{
			document.getElementById('last_name_error').innerHTML = "";
		}
		if(email.length == 0){
			document.getElementById('email_error').innerHTML = "Please Enter Your Email";
			return false;
		}else{
			document.getElementById('email_error').innerHTML = "";
		}
		if(email.match(pattern)){
			hasError++;
			document.getElementById('email_error').innerHTML = "";
		}else{
			document.getElementById('email_error').innerHTML = "Please Enter a valid email";
			return false;
		}
		if(phone_no.length == 0){
			document.getElementById('phone_no_error').innerHTML = "Enter Your Phone Number";
			return false;
		}else{
			document.getElementById('phone_no_error').innerHTML = "";
		}
		if(isNaN(phone_no)){
		document.getElementById('phone_no_error').innerHTML = "Enter a valid phone no.";
			return false;
		}else{
			document.getElementById('phone_no_error').innerHTML = "";
		}
		if(phone_no.match(phoneNum)){
			document.getElementById('phone_no_error').innerHTML = "";
		}else{
			document.getElementById('phone_no_error').innerHTML = "Enter a correct phone no.";
			return false;
		}

		if(password.length == 0){
			document.getElementById('pass_error').innerHTML = "Enter Your Password";
			return false;
		}else{
			document.getElementById('pass_error').innerHTML = "";
		}
		if(c_password.length == 0){
			document.getElementById('c_pass_error').innerHTML = "Pleas Reenter Your Password";
			return false;
		}else{
			document.getElementById('c_pass_error').innerHTML = "";
		}

		if(password !== c_password){
			document.getElementById('c_pass_error').innerHTML = "Password is not matched!";
			return false;
		}else{
			document.getElementById('c_pass_error').innerHTML = "";
		}

		var name = first_name.concat(" ", last_name);

		$.ajax({
			url:"<?= WEBBASEPATH ;?>add-user",
			method:"POST",
			data: {"name":name,"phone_no":phone_no,"email":email,"password":password},
			success: function(data){
				if(data == 1){
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: "You have registered successfully.",
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function () {
						window.location = "login";
					}, 2000);
				}else{
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: "Something is wrong!!",
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	}
</script>


</body>
</html>