<?php



    session_start();

    if(!isset($_SESSION["loggedin"])){
    header("location: index.php");
}
include_once('food.php');
include_once('drinks.php');
   
?>
<?php
				$con=mysqli_connect("localhost", "root", "");
				$jj=mysqli_select_db($con,'cu mess');
				$sql1="SELECT * From food";
				$records1=mysqli_query($con,$sql1);
				$sql2="SELECT * From drinks";
				$records2=mysqli_query($con,$sql2);
				$id=$_SESSION['id'];
$sql="SELECT * FROM students where st_id='$id'";
$result = mysqli_query($con, $sql);
$rowcount=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
	?>
<!DOCTYPE html>
 <html class="no-js">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome!</title>
	<link rel="icon" type="image/ico" href="images/0203-coffee-love.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/simple-line-icons.css">

	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

	<link rel="stylesheet" href="css/flexslider.css">

	<link rel="stylesheet" href="css/bootstrap.css">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="main.css">



<script src="https://cdn.snipcart.com/scripts/2.0/snipcart.js" id="snipcart" data-api-key="MDY0OGEwODMtOTI5YS00OTIwLTllMGMtZTI2YmZiYmM0Yzk2NjM2OTEyNzM3Njg1OTQxMDQw"></script>

<link href="https://cdn.snipcart.com/themes/2.0/base/snipcart.min.css" type="text/css" rel="stylesheet" />


	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>


	<div id="fh5co-container">
		<div class="js-sticky">
			<div class="fh5co-main-nav">
				<div class="container-fluid">
					<div class="fh5co-menu-1">
						<a href="#" data-nav-section="home">Home</a>

						<a href="#" data-nav-section="features">Today's Special</a>
					</div>
					<div class="fh5co-logo">
						<a href="loggedin.php">CU Mess</a>
					</div>
					<div class="fh5co-menu-2">
						<a href="logout.php" data-nav-section="menu">Log Out</a>
						
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<a href="cart.php"> <img style="width:30px;"src="cart.png">Cart<sup style="background-color: orange; border-radius: 40px">
<?php echo $cart_count; ?></sup></a>
<?php
}
echo "<a>Balance: ₹".$row['balance']."</a>";
?>
					</div>

				</div>

			</div>
		</div>
		<div id="fh5co-home" class="js-fullheight" data-section="home">

			<div class="flexslider">

				<div class="fh5co-overlay"></div>
				<div class="fh5co-text">
					<div class="container">
						<div class="row">
							<h1 class="to-animate">Welcome!</h1>

						</div>
					</div>
				</div>
			  	<ul class="slides">
			   	<li style="background-image: url(images/slide_1.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_2.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_3.jpg);" data-stellar-background-ratio="0.5"></li>
			  	</ul>

			</div>

		</div>
<link rel="stylesheet" type="text/css" href="css/form.css">



		<div id="fh5co-featured" data-section="features">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
				<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Food</h2>
				</div>
			</div>
							<?php
							while ($food=mysqli_fetch_assoc($records1))
							{
							?>
			<div id="first">
		<div class="wrap-contact100">
			<form action="" class="contact100-form validate-form" method="post">

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<input type='hidden' name='code' value="<?php echo $food ['food_id']; ?>" />
					<span class="label-input100">Item Name</span>
					<input class="input100" type="button" name="item_name" value="<?php echo $food ['food']; ?> ">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" >
					<span class="label-input100">Price</span>
					<input class="input100" type="button" name="price"  value="<?php echo $food ['f_price']; ?> ">
					<span class="focus-input100"></span>
				</div>





				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button type="submit" class="contact100-form-btn">
							<span>
								Add to cart!
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
							<?php
							}
							?>

</div>
</div>
		<div id="fh5co-menus" data-section="menu">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Drinks</h2>
				
					</div>
				</div>

							<?php
							while ($Drinks=mysqli_fetch_assoc($records2))
							{
							?>
<div id="first">
		<div class="wrap-contact100">
			<form action ="" class="contact100-form validate-form" method="post">

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<input type='hidden' name='code' value="<?php echo $Drinks ['drink_id']; ?>" />
					<span class="label-input100">Item Name</span>
					<input class="input100" type="button" name="item_name" value="<?php echo $Drinks ['drink']; ?> ">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" >
					<span class="label-input100">Price</span>
					<input class="input100" type="button" name="price"  value="<?php echo $Drinks ['d_price']; ?> ">
					<span class="focus-input100"></span>
				</div>





				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								Add to cart!
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php
}
?>
	</div>




			</div>
		









	<script src="js/jquery.min.js"></script>

	<script src="https://cdn.snipcart.com/scripts/2.0/snipcart.js" id="snipcart" data-api-key="MDY0OGEwODMtOTI5YS00OTIwLTllMGMtZTI2YmZiYmM0Yzk2NjM2OTEyNzM3Njg1OTQxMDQw"></script>

<link href="https://cdn.snipcart.com/themes/2.0/base/snipcart.min.css" type="text/css" rel="stylesheet" />
	<script src="js/jquery.easing.1.3.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/moment.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>

	<script src="js/jquery.waypoints.min.js"></script>

	<script src="js/jquery.stellar.min.js"></script>


	<script src="js/jquery.flexslider-min.js"></script>
	<script>
		$(function () {
	       $('#date').datetimepicker();
	   });
	</script>

	<script src="js/main.js"></script>

	</body>
</html>
