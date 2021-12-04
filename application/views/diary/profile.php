 <?php include 'includes/sessioncheck.php';
   if(isset($user)){
   	$profile = true;
   }
   else{ $profile = false;}
 ?>
<html>
<head>
	<title>daybook - Profile</title>
	<?php include 'includes/htmlhead.php';?>
  	<script type="text/javascript">


  		
  		$(document).ready(function(){


  			function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.avatar').css('background-image', 'url('+e.target.result +')');
            $('.avatar').hide();
            $('.avatar').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
			
   			
   			$("#file").change(function() {
    readURL(this);
});

		});
  	</script>


  	
	<script type="text/javascript">
		<?php if($flashdata) { ?>
			window.alert("<?php echo $this->session->flashdata('message');?>");
		<?php } ?>
	</script>
</head>
<body class="row-background">
	<header class="container-fluid">
		<div class="row header">
			<div class="col-2">
				<div class="menu-btn" data-toggle="tooltip" title="Home">
					<a href="<?php echo site_url('Index');?>" id="back" style="color:black;"><i class="fa fa-home fa-2x"></i></a>
				</div>
			</div>

			<div class="col brand">
				<h3>daybook</h3>
			</div>

			<?php include 'includes/profiledopdown.php';?>
		</div>
	</header>


	<section class="container">
		<div class="row">
			<div class="col">
				<div class="userprofile">
					<!--image upload-->
					<div class="row">
					<div class="col-sm-4">
						<div class="avatar" style="background-image: url('<?php if($profile){echo $user[0]->avatar;}?>');">
							<div class="" data-toggle="tooltip" title="upload image">
							<?php echo form_open_multipart('Daybook/uploadAvatar');?>
								<input type="file" name="avatar" id="file"/>
							<label for="file" class="avatar-upload-btn fa fa-pencil"></label>
							</div>
						</div>
						<button class="form-control btn upload-btn" type="submit" name="submit" value="upload" id="saveprofile"><span class="fa fa-upload"></span> Upload</button>
						<?php echo form_close();?>
					</div>
					<!--<button class="btn" id="editprofile" style="color: grey;">
						<i class="fas fa-pencil-square-o" aria-hidden="true"></i> Edit Profile
					</button>
					<div class="separator"></div>-->
					<div class="col">
						<br>
						<br>
						<?php echo form_open('Daybook/updateprofile');?>
						<label class="label">Full Name: </label><input id="input" value="<?php       if($profile){echo $user[0]->name;}?>" type="text" name="fullname" class="form-control select form-control-sm" placeholder="Full Name">
						<div class="error"><?php echo form_error('fullname');?></div>
						<label class="label">User Name: </label><input id="input" value="<?php if($profile){echo $user[0]->user_name;}?>" type="text" name="username" class="form-control select form-control-sm" placeholder="User Name">
						<div class="error"><?php echo form_error('username');?></div>
						<label class="label">Email Id </label><input id="input" value="<?php if($profile){echo $user[0]->email_id;}?>" type="email" name="email" class="form-control select form-control-sm" placeholder="Email Id">
						<div class="error"><?php echo form_error('email');?></div>
						<!--<label class="label">Change Password: </label><input id="input" type="password" name="rpassword" class="form-control select form-control-sm" placeholder="re-enter password">-->
						<a href="" style="color: grey; margin: 6px; font-size: 0.9em;">Change Password</a>
						<button class="form-control form-control-sm btn" type="submit" name="submit" value="save" id="saveprofile">Save</button>
					<?php echo form_close();?>
					</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>