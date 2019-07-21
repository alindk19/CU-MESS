<?php
$status="";
$link = mysqli_connect("localhost", "root", "", "cu mess");
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query(
$link,
"SELECT * FROM `drinks` WHERE `drink_id`='$code'"
);
$row = mysqli_fetch_assoc($result);
$name = $row['drink'];
$code = $row['drink_id'];
$price = $row['d_price'];
 
$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1)
);
if(mysqli_num_rows($result)>0){
 $cartArray=array_unique($cartArray);
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
     echo "<script> alert('Product is added to your cart!');</script>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
		echo "<script> alert('Product is already added to your cart!');</script>";
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}
 
	}
}
}
?>