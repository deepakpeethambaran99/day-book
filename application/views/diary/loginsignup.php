<!DOCTYPE html>
<html>
<head>
	<title>Login-Signup - daybook</title>
	<?php include 'includes/htmlhead.php';?>
  	<?php if(isset($pres)){?>
  	<script type="text/javascript">
		$(document).ready(function(){
   		 $("#reg-btn").trigger('click'); 
		});
	</script>
<?php } ?>


	
</head>
<body>
	<script type="text/javascript">
		<?php if(isset($response)){
				if($response == "registration failed"){
			?>
				alert("<?php echo $message;?>");
		<?php }} ?>
	</script>
	<header>
		<div class="header login">
			<a href="<?php echo site_url('Index');?>"><h3>daybook</h3></a> 
		</div>
	</header>
	
	<section class="container-fluid">
		<div class="row form-box">
			<div class="col">
				<div class="card form">
					<div class="card-header toggle-btn">
						<button class="btn focus" id="login-btn">Login</button>
						<button id="reg-btn" class="btn">Register</button>
					</div>

					<div class="card-body">
						<div class="form-login">
						<?php echo form_open('Daybook/loginuser');?>
							<div class="error"><?php if(isset($response)){
												if($response == "login-failed"){
													echo $message;
												}} ?></div>
							<input class="form-control m-2" type="text" name="username" placeholder="User name">
							<div class="error"><?php echo form_error('username');?></div>
							<input class="form-control m-2" type="password" name="password" placeholder="password">
							<div class="error"><?php echo form_error('password');?></div>
							<!--<input class="checkbox m-2" type="checkbox" name="remember"><span> remember me</span>-->

							<button  type="submit" name="submit" class="form-control btn m-2 mt-4" value="login"> Login</button>
							<?php echo form_close();?>
						</div>
						<div class="form-reg">
							<?php echo form_open('Daybook/loginuser');?>
							<input class="form-control m-2" type="text" name="name" placeholder="Full Name">
							<div class="error"><?php echo form_error('name');?></div>
							<input class="form-control m-2" type="text" name="user_name" placeholder="User Name">
							<div class="error"><?php echo form_error('user_name');?></div>
							<input class="form-control m-2" type="email" name="emailid" placeholder="Email id">
							<div class="error"><?php echo form_error('emailid');?></div>
							<input class="form-control m-2" type="password" name="regpassword" placeholder="password">
							<div class="error"><?php echo form_error('regpassword');?></div>
							<input class="form-control m-2" type="password" name="cpassword" placeholder="confirm password">
							<div class="error"><?php echo form_error('cpassword');?></div>
							<button  type="submit" name="submit" value="register" class="form-control btn m-2 mt-4"> Register now</button>
						<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="page-footer font-small blue">

  	<!-- Copyright -->
  		<div class="footer-copyright text-center py-3 footer">© 2020 Copyright: the d33
  		</div>
  		<!-- Copyright -->

	</footer>
</body>
</html>