 <?php include 'includes/sessioncheck.php';
 		
 ?>
<html>
<head>
	<title>daybook</title>
	<?php include 'includes/htmlhead.php';?>
</head>

<body>

	<script type="text/javascript">
		<?php if($flashdata) { ?>
			window.alert("<?php echo $this->session->flashdata('message');?>");
		<?php } ?>
	</script>

	<header class="container-fluid">
		<div class="row header">
			<div class="col-2">
				<!--<div class="menu-btn" data-toggle="tooltip" title="Menu">
					<div class="bar1"></div>
		  			<div class="bar2"></div>
		  			<div class="bar3"></div>
				</div>-->
			</div>

			<div class="col brand">
				<h3>daybook</h3>
			</div>
			<?php include 'includes/profiledopdown.php';?>
			
		</div>
	</header>

	<section class="container-fluid">
		<div class="row row-background">
			<!--<nav class="nav-bar">
				<a href="index.html"><div class="nav-link"><p><span class="fas fa-home"></span> Home</p></div></a>
				<a href="#link2"><div class="nav-link"><p>Link 2</p></div></a>
				<a href="#link3"><div class="nav-link"><p>Link 3</p></div></a>
				<a href="#link4"><div class="nav-link"><p>Link 4</p></div></a>
			</nav>-->
			<div class="col-sm">
				<div class="content">
					<div class="col"></div>
					<div class="col">
						<div class="notebook" id="nb_1">
							<div class="jdetail">
								<div class="jdetail-head">
									<h2>Untitiled Journal</h2>
								</div>
								<div class="jdetail-body">
									<strong>Author:</strong><br>
									<div class="separator"></div>
									<a href="<?php echo site_url('entries');?>"><span class="fas fa-book-open"></span> Open Journal</a><br>
									<button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
										<i class="fas fa-pencil-square-o" aria-hidden="true"></i> Edit
									</button>
								</div>

							<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Untitle Journal</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        	<input class="form-control" type="text" name="author" placeholder="Journal Title">
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-primary">Save changes</button>
								      </div>
								    </div>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col"></div>
				</div>


			</div>
		</div>
	</section>
	<!-- Footer -->
	<footer class="page-footer font-small blue">

  	<!-- Copyright -->
  		<div class="footer-copyright text-center py-3 footer">© 2020 Copyright: the d33
  		</div>
  		<!-- Copyright -->

	</footer>
<!-- Footer -->

</body>
</html>