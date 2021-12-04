
<html>
<head>
	<title>Error</title>
	<?php require "htmlhead.php";?>
</head>
<body>
	<div class="container m-5" style="border: 1px solid red;">
		<div class="row">
			<p class="p-5"><?php
				if(isset($message)){
					echo $message;
				} 
			?></p>
		</div>
	</div>
</body>
</html>