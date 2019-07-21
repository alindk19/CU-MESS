<?php
session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: loggedin.php");
    exit;
}

require_once "connection.php";

$id = $password = "";
$id_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["id"]))){
        $id_err = "Please enter id.";
    } else{
        $id = trim($_POST["id"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($id_err) && empty($password_err)){
        $sql = "SELECT id, password FROM students WHERE id = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_id);
            $param_id = $id;


            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);


                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password==password){

                            session_start();


                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;

                            header("location: login.php");
                        } else{

                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{

                    $id_err = "No account found with that id.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>
	<?php
				$con=mysqli_connect("localhost", "root", "");
				$jj=mysqli_select_db($con,'users');
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
	<title>CU Mess</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />


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
            <a href="index.html">CU Mess</a>
          </div>
          <div class="fh5co-menu-2">
            <a href="#" data-nav-section="menu">Contact Us!</a>
            <a href="index2.php" data-nev-section="admin"> &nbsp; Admin</a>


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
          <div id="error" style="color:red;"></div>
					<form  method="post" id="loginform">
						<label for="id">Id:
						</label>
						<input type="text" id="id" name="id" required><br>
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
						<h2 class="heading to-animate">Today's Menu</h2>

					</div>
				</div>
			<div class="row text-center fh5co-heading row-padded">
				<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Food</h2>
				</div>
			</div>
			<link rel="stylesheet" type="text/css" href="table/css/table.css">
			<div class="limiter">

			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>

							<tr class="table100-head">
								<th class="column1">Menu</th>
								<th class="column2">Price</th>
							</tr>
							</thead>
							<tbody>
							<?php
							while ($food=mysqli_fetch_assoc($records1))
							{
							echo "<tr>";
							echo "<td>".$food['food_name']."</td>";
							echo "<td><label>₹</label>".$food['price']."</td>";
							echo "</tr>";
							}
							?>

					</tbody>
				</table><br><br><br>


					</div>
			</div>

		<div class="row text-center fh5co-heading row-padded">
				<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Drinks</h2>
				</div>
			</div>
	</div>
	<div class="limiter">

			<div class="wrap-table100"-->
				<div class="table100">
					<table>
						<thead>

							<tr class="table100-head">
								<th class="column1">Menu</th>
								<th class="column2">Price</th>
							</tr>
							</thead>
							<tbody>
							<?php
							while ($Drinks=mysqli_fetch_assoc($records2))
							{
							echo "<tr>";
							echo "<td>".$Drinks['drink_name']."</td>";
							echo "<td><label>₹</label>".$Drinks['price']."</td>";
							echo "</tr>";
							}
							?>

					</tbody>
				</table>


					</div>
			</div>

	</div>

			</div>
		</div>








	<div id="fh5co-footer">
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">


				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="fh5co-social">
						<li class="to-animate-2"><a href="#"><i class="icon-facebook"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-twitter"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-instagram"></i></a></li>
					</ul>
				</div>
			</div>
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
