<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Login Form with Avatar Image</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #d47677;
}
.form-control {
	min-height: 41px;
	background: #fff;
	box-shadow: none !important;
	border-color: #e3e3e3;
}
.form-control:focus {
	border-color: #70c5c0;
}
.form-control, .btn {        
	border-radius: 2px;
}
.login-form {
	width: 350px;
	margin: 0 auto;
	padding: 100px 0 30px;		
}
.login-form form {
	color: #7a7a7a;
	border-radius: 2px;
	margin-bottom: 15px;
	font-size: 13px;
	background: #ececec;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;	
	position: relative;	
}
.login-form h2 {
	font-size: 22px;
	margin: 35px 0 25px;
}
.login-form .avatar {
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -50px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #70c5c0;
	padding: 15px;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar img {
	width: 100%;
}	
.login-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}
.login-form .btn, .login-form .btn:active {        
	font-size: 16px;
	font-weight: bold;
	background: #70c5c0 !important;
	border: none;
	margin-bottom: 20px;
}
.login-form .btn:hover, .login-form .btn:focus {
	background: #50b8b3 !important;
}    
.login-form a {
	color: #fff;
	text-decoration: underline;
}
.login-form a:hover {
	text-decoration: none;
}
.login-form form a {
	color: #7a7a7a;
	text-decoration: none;
}
.login-form form a:hover {
	text-decoration: underline;
}
.login-form .bottom-action {
	font-size: 14px;
}
</style>
</head>
<body>
<div class="login-form">
    <form method="post">
		<div class="avatar">
			<!-- <img src="uploads/avatar.png" alt="Avatar"> -->
		</div>
        <h2 class="text-center">Member Login</h2>   
        <div class="form-group">
        	<input type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" >
            <span id="phone_no_error"  class=" pull-left" style="color:red;"></span>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" >
            <span id="password_error"  class=" pull-left" style="color:red;"></span>
        </div>        
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="login()">Sign in</button>
        </div>
		<div class="bottom-action clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>
    </form>
    <p class="text-center small">Don't have an account? <a href="<?= WEBBASEPATH ?>registration">Sign up here!</a></p>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

	function login(){
		var phone_no = $("#phone_no").val();
		var password = $("#password").val();
		var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		var hasError = 0;
            
        
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
			document.getElementById('password_error').innerHTML = "Enter Your Password";
			return false;
		}else{
			document.getElementById('password_error').innerHTML = "";
		}
		

		$.ajax({
			url:"<?= WEBBASEPATH ;?>login-action",
			method:"POST",
			data: {"phone_no":phone_no,"password":password},
			success: function(data){
				if(data == 1){
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: "Welcome",
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function () {
						window.location = "home";
					}, 2000);
				}else if(data==2){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: "Wrong Password / Phone No.",
						showConfirmButton: false,
						timer: 1500
					});
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