<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$sername = $_POST['sername'];
		$serdesc = $_POST['serdesc'];
		$cost = $_POST['cost'];
		$image = $_FILES["image"]["name"];

		if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
			$image = $_FILES["image"]["name"];
			$extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
			$allowed_extensions = array("jpg", "jpeg", "png", "gif");

			if (!in_array($extension, $allowed_extensions)) {
				echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
			} else {
				// Create directory if it doesn't exist
				if (!file_exists("images")) {
					mkdir("images", 0777, true);
				}
				$newimage = md5($image . time()) . '.' . $extension;
				if (move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $newimage)) {
					// Insert into database
					$query = mysqli_query($con, "INSERT INTO tblservices(ServiceName, ServiceDescription, Cost, Image) 
                    VALUES ('$sername', '$serdesc', '$cost', '$newimage')");

					if ($query) {
						echo "<script>alert('Service has been added successfully.');</script>";
						echo "<script>window.location.href = 'manage-services.php'</script>";
					} else {
						echo "<script>alert('Database Error: " . mysqli_error($con) . "');</script>";
					}
				} else {
					echo "<script>alert('Failed to upload image. Check directory permissions.');</script>";
				}
			}
		} else {
			echo "<script>alert('Please select an image file.');</script>";
		}
	}
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Admin Vio| Add Services</title>

		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- //font-awesome icons -->
		<!-- js-->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<!--webfonts-->
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
		<!--animate-->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
		<!--//end-animate-->
		<!-- Metis Menu -->
		<script src="js/metisMenu.min.js"></script>
		<script src="js/custom.js"></script>
		<link href="css/custom.css" rel="stylesheet">
		<!--//Metis Menu -->
	</head>

	<body class="cbp-spmenu-push">
		<div class="main-content">
			<!--left-fixed -navigation-->
			<?php include_once('includes/sidebar.php'); ?>
			<!--left-fixed -navigation-->
			<!-- header-starts -->
			<?php include_once('includes/header.php'); ?>
			<!-- //header-ends -->
			<!-- main content start-->
			<div id="page-wrapper">
				<div class="main-page">
					<div class="forms">
						<h3 class="title1">Add Services</h3>
						<div class="form-grids row widget-shadow" data-example-id="basic-forms">
							<div class="form-title">
								<h4>Parlour Services:</h4>
							</div>
							<div class="form-body">
								<form method="post" enctype="multipart/form-data">
									<p style="font-size:16px; color:red" align="center">
										<?php if ($msg) {
											echo $msg;
										}  ?> </p>
									<div class="form-group"> <label for="exampleInputEmail1">Service Name</label> <input type="text" class="form-control" id="sername" name="sername" placeholder="Service Name" value="" required="true"> </div>
									<div class="form-group"> <label for="exampleInputEmail1">Service Description</label> <textarea type="text" class="form-control" id="sername" name="serdesc" placeholder="Service Description" value="" required="true"></textarea> </div>
									<div class="form-group"> <label for="exampleInputPassword1">Cost</label> <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="" required="true"> </div>
									<div class="form-group"> <label for="exampleInputEmail1">Images</label> <input type="file" class="form-control" id="image" name="image" value="" required="true"> </div>
									<button type="submit" name="submit" class="btn btn-default">Add</button>
								</form>
							</div>

						</div>


					</div>
				</div>

			</div>
			<!-- Classie -->
			<script src="js/classie.js"></script>
			<script>
				var menuLeft = document.getElementById('cbp-spmenu-s1'),
					showLeftPush = document.getElementById('showLeftPush'),
					body = document.body;

				showLeftPush.onclick = function() {
					classie.toggle(this, 'active');
					classie.toggle(body, 'cbp-spmenu-push-toright');
					classie.toggle(menuLeft, 'cbp-spmenu-open');
					disableOther('showLeftPush');
				};

				function disableOther(button) {
					if (button !== 'showLeftPush') {
						classie.toggle(showLeftPush, 'disabled');
					}
				}
			</script>
			<!--scrolling js-->
			<script src="js/jquery.nicescroll.js"></script>
			<script src="js/scripts.js"></script>
			<!--//scrolling js-->
			<!-- Bootstrap Core JavaScript -->
			<script src="js/bootstrap.js"> </script>
			
	</body>

	</html>
<?php } ?>