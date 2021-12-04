<?php include 'includes/sessioncheck.php';
    if(isset($data)){
    	$entry = true;
    }
    else $entry = false;

    $id = 0;
    if(isset($_POST['id'])){
    	$id = $_POST['id'];
    }
?>
<html>
<head>
	<title>daybook - Journal</title>
	<?php include 'includes/htmlhead.php';?>
  	<!--<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/inline/ckeditor.js"></script>-->
  	<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/inline/ckeditor.js"></script>
  	<?php require 'includes/uploader.php';?>



<style type="text/css">
	.journal-page .btn{
		border: none;
		float: right;
	}

	.journal-page .btn:hover{
		color:grey;
		text-decoration: underline;
		text-decoration-color: black;
	}
</style>

</head>
<body>
	<header class="container-fluid">
		<div class="row header">
			<div class="col-2">
				<div class="menu-btn" data-toggle="tooltip" title="Menu">
					<div class="bar1"></div>
		  			<div class="bar2"></div>
		  			<div class="bar3"></div>
				</div>
			</div>

			<div class="col brand">
				<h3>daybook</h3>
			</div>

			<div class="col profile">
			<?php include 'includes/profiledopdown.php';?>
		</div>
	</header>
<!--modal-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	    <p>Are you sure you want to delete this entry?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="submit"  class="btn btn-primary" id="yes">Yes</button>
	        <button type="button" data-dismiss="modal"  class="btn btn-primary">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>




	<section class="container-fluid">
		<div class="row row-background">
			<nav class="nav-bar">
				<a href="<?php echo site_url('Index');?>"><div class="nav-link"><p><span class="fas fa-home"></span> Home</p></div></a>
				<a href="<?php echo site_url('entries/journal');?>"><div class="nav-link"><p>New Entry</p></div></a>
				<a href="<?php echo site_url('entries');?>"><div class="nav-link"><p>View Entries</p></div></a>
				<a href="#link4"><div class="nav-link"><p>Link 4</p></div></a>
			</nav>

			<div class="container">
                <form>
				<div class="journal-page" style="overflow: hidden;">
                    <input id="entry-id" type="text" name="entryid" value="<?php echo $entry?$data[0]->d_id:'none'; ?>">
                    <div class="btn fa fa-trash" data-toggle="modal" data-target="#exampleModal"  id="delete"> Delete</div >
                     <div class="btn fa fa-edit"  id="edit"> Edit </div >
                    <div class="btn fa fa-save"  id="save"> Save  <span style="color: green; font-weight: bolder;" id="saved"> </span></div>
                    <br><hr>
					<input id="title" type="text" name="title" placeholder="Title" class="form-control select form-control-sm title" value="<?php echo $entry?$data[0]->title:''; ?>">
					<p style="color:grey;"><?php echo $entry?$data[0]->created:''?></p>
					<!--<p style="color: grey; padding-top: 5px;">Date: <?php //echo date('d/m/y H:i:a');?></p>-->
                    
					<div id="editor" class="text-inline mt-5">
						<?php echo $entry?$data[0]->content:"Your text here..."; ?>
					</div>
        		</div>
                </form>
			</div>
		</div>
	</section> 



</body>
</html>