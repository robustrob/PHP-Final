<html>
<head>
    <?php
    $page = 'booking';
    require_once '../BookingApp/view/header.php';
    ?>
</head>
<body>



<div class="container">

    <?php require_once '../BookingApp/view/navbar.php' ?>


    <div class="col-xs-1 col-md-2 col-lg-3"></div>
	<div class="col-xs-10 col-md-8 col-lg-6">



	<?php

		
		$date = '';
		
		if(isset($data['date']) && $data['date'] != '')
		{
			$time = strtotime($data['date']);

			$date = date('d-m-Y',$time);			
		}
		else
		{
			$date = date('d-m-Y');
		}
		
		
		
		echo '<h4>Date: ' .$date.'</h4>';


	?>
	
	</div>


</div>





</body>
</html>   