 <?php include 'includes/sessioncheck.php';?>
<html>
<head>
	<?php include 'includes/htmlhead.php';?>
  	</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#back').click(function(){
				parent.history.back();
				return false;
		});
	});
</script>

</head>
<body class="row-background">
	<header class="container-fluid">
		<div class="row header">
			<div class="col-2">
				<div class="menu-btn" data-toggle="tooltip" title="back">
					<a href="" id="back" style="color:black;"><i class="fa fa-long-arrow-left fa-2x"></i></a>
				</div>
			</div>

			<div class="col brand">
				<h3>daybook</h3>
			</div>

			<?php include 'includes/profiledopdown.php';?>
		</div>
	</header>

	<section class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="content center" id="developer">	
					<h4><u>Developer</u></h4>
					<img src = "<?php echo base_url(); ?>css/img/d33-logo.png"/>
					<h5>Deepak K Pitmbaran</h5>
					<p>Student,<br>Pursuing B.Tech in Computer Science from Vyas Intitute of Engineering and Technology</p>
					<p>Social Media:</p>
					<a href="https://www.instagram.com/dee_p.r._"><i class="fa fa-instagram" data-toggle="tooltip" title="instagram" aria-hidden="true"></i></a>
					<a href="https://www.linkedin.com/in/deepak-k-pitmbaran-a33086187/" data-toggle="tooltip" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					<a href="https://www.linkedin.com/in/deepak-k-pitmbaran-a33086187/"><i class="fa fa-gmail" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</section>



</body>
</html>