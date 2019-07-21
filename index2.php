<?php

    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}
    $error = "";

    if (array_key_exists("submit", $_POST)) {

        $link = mysqli_connect("localhost", "root", "", "cu mess");

      /*  if (mysqli_connect_error()) {

            die ("Database Connection Error");

        }*/



        if (!$_POST['username']) {

            $error .= "A username is required<br>";

        }

        if (!$_POST['password']) {

            $error .= "A password is required<br>";

        }

        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;

        }


             else {

                    $query = "SELECT * FROM `admins` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."'";

                    $result = mysqli_query($link, $query);

                    $row = mysqli_fetch_array($result);

                    if (isset($row)) {

                        $passwor = $_POST['password'];

                        if ($passwor == $row['password']) {

                            $_SESSION['id'] = $row['id'];
                            $_SESSION['loggedin']=true;
                            $_SESSION['username'] =$row['username'];


                            header("Location: admin.php");

                        } else {

                            $error = "That email/password combination could not be found.";

                        }

                    } else {

                        $error = "That email/password combination could not be found.";

                    }

                }

}
?>

	<?php
				$con=mysqli_connect("localhost", "root", "");
				$jj=mysqli_select_db($con,'cu mess');
				$sql1="SELECT * From food";
				$records1=mysqli_query($con,$sql1);
				$sql2="SELECT * From drinks";
				$records2=mysqli_query($con,$sql2);


	?>

<!DOCTYPE html>
<html>
	<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CU Mess - Admin</title>
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
  <link rel="stylesheet" href="css/form.css">
	<script src="js/modernizr-2.6.2.min.js"></script>
	</head>
	<body>

	<div id="fh5co-container">
    <div class="js-sticky">
      <div class="fh5co-main-nav">
        <div class="container-fluid">
          <div class="fh5co-menu-1">
            <a href="#" data-nav-section="home">Home</a>
            <a href="#" data-nav-section="about">Login</a>
            <a href="#" data-nav-section="features">Today's menu</a>
          </div>
          <div class="fh5co-logo">
            <a href="index2.php">CU Mess</a>
          </div>
          <div class="fh5co-menu-2">
            <a href="index.php" data-nev-section="admin"> &nbsp; Student</a>


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
							<h1 class="to-animate">CU Mess</h1>

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



		<div id="fh5co-about" data-section="about">
			<div class="fh5co-2col fh5co-bg to-animate-2" style="background-image: url(images/res_img_1.jpg)"></div>
			<div class="fh5co-2col fh5co-text">
				<h2 class="heading to-animate">Login</h2>
				<div id="container">
          <div id="error" style="color:red;"><?php echo $error; ?></div>
					<form  method="post" id="loginform">
						<label for="username">Username:
						</label>
						<input type="text" id="username" name="username" required><br>
						<label for="password">Password:
						</label>
						<input type="password" id="password" name="password" required>
						<div id="lower">

							<input type="submit" name="submit" value="Login">
						</div>
					</form>

				</div>

			</div>
		</div>



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
			<form class="contact100-form validate-form">

				<div class="wrap-input100 validate-input" data-validate="Name is required">
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
			<form class="contact100-form validate-form">

				<div class="wrap-input100 validate-input" data-validate="Name is required">
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
