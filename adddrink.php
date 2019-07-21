<?php
require_once "connection.php";
 
$drink = $dprice = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["drinkid"]))){
        $drink_err = "Please enter drink name";
    }   
    else{
    	$drink_id=trim($_POST["drinkid"]);
    } 
    if(empty(trim($_POST["drink"]))){
        $drink_err = "Please enter drink name";
    }   
    else{
    	$drink=trim($_POST["drink"]);
    }  
    if(empty(trim($_POST["dprice"]))){
        $dprice_err = "Please enter Drink Price.";     
    } else{
        $dprice = trim($_POST["dprice"]);
    }
    if(empty($drink_err) && empty($dprice_err)){
        $sql = "INSERT INTO drinks (drink_id,drink, d_price) VALUES (?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss",$param_drink_id, $param_drink, $param_dprice);
            $param_drink_id=$drink_id;
            $param_drink = $drink;
            $param_dprice = $dprice; 
            if($stmt->execute()){
                header("location: admin.php?addDrink=successfull");
            } else{
                echo "<script>alert('Something Wrong');</script>";
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CU Mess </title>
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

	<script src="js/modernizr-2.6.2.min.js"></script>
	</head>
	<body>

	<div id="fh5co-container">
    <div class="js-sticky">
      <div class="fh5co-main-nav">
        <div class="container-fluid">
          <div class="fh5co-menu-1">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Menu<span class="caret"></span></a>
          <ul class="dropdown-menu" style="left:19%;">
            <li><a href="addfood.php">Add Food</a></li>
            <li><a href="adddrink.php">Add Drink</a></li>
          </ul>
            <a href="addstudent.php" data-nav-section="about">Add Student</a>
            <a href="addbalance.php" data-nav-section="about">Add Balance</a>
          </div>

          <div class="fh5co-logo">
            <a href="admin.php">CU Mess</a>
          </div>
          <div class="fh5co-menu-2">
            <a href="logout.php" data-nav-section="menu">Log Out</a>

          </div>
        </div>

      </div>
    </div>
		<div id="fh5co-home" class="js-fullheight" data-section="home">

			<div class="flexslider">

				<div class="fh5co-overlay"></div>
				<div class="fh5co-text">
					<div class="container">
						<form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
							<input type="text" name="drinkid" placeholder="Drink Code">
							<input type="text" name="drink" placeholder="Drink Name">
							<input type="text" name="dprice" placeholder="Drink Price">
							<input type="submit" value="Add Drink">
						</form>
					</div>
				</div>
			  	<ul class="slides">
			   	<li style="background-image: url(images/slide_1.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_2.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_3.jpg);" data-stellar-background-ratio="0.5"></li>
			  	</ul>

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
</script>
	</body>
</html>
