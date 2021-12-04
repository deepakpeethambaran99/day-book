<?php include 'includes/sessioncheck.php';
   
 ?>
<html class="row-background">
<head>
	<title>daybook - entries</title>
	<?php include 'includes/htmlhead.php';?>

  	<script type="text/javascript">
  		$(document).ready(function(){
  			$('#newentry').click(function(){
  				 $(location).attr('href','journal.html');
			});
			$("#d").hide();

			$(".delete").click(function(){
				var id = $(this).attr("id");
				id = id.slice(6);
				$("#d").val(id);
			});

			$('#yes').click(function(){
	            var baseurl = "<?php echo base_url();?>"
	            var id = $("#d").val();
	            //alert("title: "+title);
	            $.ajax({
	            type:"GET",
	            url:baseurl+"delete",
	            dataType: "TEXT",
	            data: {d:id},
	            error: function(error){console.log("error: "+error);},
	            success: function(data){
	            	location.reload();
	            }
           	});
	       });     

			$('#days').change(function(){
				var opt = $(this).val();
				var baseurl = '<?php echo base_url();?>';
				//window.location.replace(baseurl+"filter?opt="+opt);
       			//alert("hello! this is working... you opt for "+opt);
       			$.ajax({
		            type:"GET",
		            url:baseurl+"filter",
		            dataType: "TEXT",
		            data: {opt: opt},
		            error: function(error){console.log("error: "+error);},
		            success: function(data){
		               var response = jQuery.parseJSON(data);
		               console.log(response.entries);
		                $.ajax({
				            type: 'post',
				            data: response, //Pass the id
				        });
		            }
		        });
     		}); 

  		});
  	</script>

  	<style type="text/css">
  		.table a{
  			color: black;
  		}
  		.table a:hover{
  			font-size: 1.3em;
  			font-weight: bolder;
  		}

  		#newentry{
  			position: sticky;
  			bottom:0;
  		}
  	</style>

</head>
<body class="row-background">

	<header class="container-fluid">
		<div class="row header">
			<div class="col-2">
				<div class="menu-btn" data-toggle="tooltip" title="Home">
					<a href="<?php echo site_url('Index');?>" style="color:black;"><i class="fa fa-home fa-2x"></i></a>
				</div>
			</div>

			<div class="col brand">
				<h3>daybook</h3>
			</div>

		<?php include 'includes/profiledopdown.php';?>
		</div>
	</header>

	<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Alert! Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="text" name="d" id="d">
        <p>Are you sure you want to delete this entry?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="yes" data-dismiss="modal" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>


	<section class="container-fluid" >
		<div class="row">
			<div class="col">
				<!--entry title-->
				<div class="entry-title container">
					<h3>Untitled Journal</h3>
					<p>Author : <?php echo $this->session->userdata('name');?></p>
					<p>Total Entries: <?php echo $entries?sizeof($entries):0;?></p>
					<div class="separator"></div>
					<div class="row">
						<div class="col-sm p-3">
							<select class="form-control select" id="days">
								<option value="a"> All Entries</option>
								<option value="t"> Today </option>
								<option value="y"> Yesterday </option>
								<option value="lw"> Last Week </option>
								<option value="lm"> Last Month </option>
							</select>
						</div>

						<div class="col-sm p-3"><input type="month" name="date" class="form-control select form-control-sm"></div>
						<div class="col-sm p-3">
							<div class="search">
								<span class="fa fa-search mt-2" style="float:left;"></span>
								<input type="text" name="search" placeholder="Search by Title" class="form-control form-control-sm">
							</div>
		  				</div>
		  			</div>
				</div>

				<!--entry table-->
				<div class="container entry-table center">
					<?php if($entries){?>
					<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">Sr No.</th>
						      <th scope="col">Entries</th>
						      <th scope="col">Date (Created)</th>
						      <th scope="col">Delete</th>
						    </tr>
						  </thead>
						  <tbody>
						<?php $i = 1; 
						  	foreach($entries as $row){
						?>
						    <tr>
						      <th scope="row" id="d"><?php echo $i; ?></th>
						      <td id="d1"><a href='entries/journal?id=<?php echo $row->d_id;?>'><?php echo $row->title; ?></a></td>
						      <td id="d2"><?php echo $row->created; ?></td>
						      <td id="d3"><div data-target="#exampleModalCenter" class="delete" style="cursor:pointer;"data-toggle="modal" id="delete<?php echo $row->d_id;?>" ><i class="fa fa-trash"></i></p></div></td>
						    </tr>
						<?php $i+=1;}?>
						  </tbody>
						</table>
					<?php } else {?>
						<p style="color:grey;">No entries found</p>
					<?php } ?>
					<hr>
						<a href="<?php echo site_url('entries/journal');?>"><button class="form-control btn form-control-sm m-3" id="newentry"><span class="fa fa-plus"></span> New Entry</button></a>
				</div>




			</div>
		</div>
	</section>
</body>
</html>