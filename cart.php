<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}
 
if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break;
    }
}
  	
}
$id=$_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "cu mess");
$bal="SELECT * FROM students where st_id='$id'";
$result = mysqli_query($con, $bal);
$rowcount=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);


if(isset($_POST['pay'])){
  $link = mysqli_connect("localhost", "root", "", "cu mess");
$sql="SELECT * FROM students where st_id='$id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$total=$_POST['total'];
$rowcount=mysqli_num_rows($result);
if($row['balance']>=$total)
{
  $order=0;
  $balance=$row['balance']-$total;
  $pay="UPDATE students SET balance='$balance' where st_id='$id'";
  if(mysqli_query($link, $pay))
  {
    $unique_id = mt_rand() . $id;
    echo "<script>alert('Order Successfull');</script>";
    echo "<script>alert('Order id =".$unique_id."');</script>";
    header("Refresh:0");


  }
  else
    echo "<script>alert('There is some error');</script>";
}
else
{
  echo "<script>alert('Not Enough Balance');</script>";
}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
  <link rel="icon" type="image/ico" href="images/0203-coffee-love.png" />
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="css/table1.css">
<style>
body, html {
  height: 100%;
  margin: 0;
}
button {
  
}
button:active {
  box-shadow: 0px 2px 0px 0px rgba(0,0,0,.2);
  top: 1px;
}


button.back {
  float:left;
  width: 130px;
  height: 40px;
  background: linear-gradient(to bottom, #4eb5e5 0%,#389ed5 100%); 
  border: none;
  border-radius: 5px;
  position: relative;
  border-bottom: 4px solid #2b8bc6;
  color: #fbfbfb;
  font-weight: 600;
  font-family: 'Open Sans', sans-serif;
  text-shadow: 1px 1px 1px rgba(0,0,0,.4);
  font-size: 15px;
  text-align: center;
  text-indent: 5px;
  box-shadow: 0px 3px 0px 0px rgba(0,0,0,.2);
  cursor: pointer;
  display: block;
  margin: 0 auto;
  margin-bottom: 20px;
  text-align: center;
  padding-right: 12px;
  box-sizing: border-box;
  position: absolute;
   left:5%;
  top:5%;
}

.bg {
  
  background-image: url("bg1.jpg");

 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  min-height: 100%;
  min-width: 1024px;
  
  width: 100%;
  height: auto;
  position: fixed;
  top: 0;
  left: 0;
}
</style>
</head>
<body>
  <div class="bg">

  <button class="back" onclick="location.href='loggedin.php';">Back</button>
  <div style="margin:4vh 8vh 0 0; font-size: 20px; color:white; float: right;">
  <?php
        echo "<a>Balance: ₹".$row['balance']."</a>";
    ?>
  </div>
  <div class="container-table100">
  <div class="wrap-table100">
      <div class="table100">
          <?php
          if(isset($_SESSION["shopping_cart"])){
           $total_price = 0;
          ?>	
            <table>
            <thead>
              <tr class="table100-head">
               
                <th class="column1">ITEM NAME</th>
                <th class="column2">QUANTITY</th>
                <th class="column3">UNIT PRICE</th>
                <th class="column4">ITEMS TOTAL</th>
              </tr>	
            </thead>
<tbody>
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>

<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>

<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product['quantity']==1) echo " selected ";?>
value="1">1</option>
<option <?php if($product['quantity']==2) echo " selected ";?>
value="2">2</option>
<option <?php if($product['quantity']==3) echo " selected ";?>
value="3">3</option>
<option <?php if($product['quantity']==4) echo " selected ";?>
value="4">4</option>
<option <?php if($product['quantity']==5) echo " selected ";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "₹".$product["price"]; ?></td>
<td><?php echo "₹".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
</tbody>

<tbody>
<tfoot><tr>
  <td></td>
  <td></td>
  <td></td>
  
 <td> TOTAL: <?php echo "₹".$total_price; ?></td>
  </tr></tfoot>
  <tbody><form action= " " method="post">
<tfoot><tr>
  <td></td>
  <td></td>
  <td></td>
   <td><input type="submit" name="pay" value="Pay with Balance">
    <input type="hidden" name="total" value="<?php echo $total_price;?>">
   </td>
 </tr>
</tfoot>
</form>
</tbody>
</table>		
  <?php
}
else{
	echo "<script>alert('Your cart is empty!');</script>";
  header("location:loggedin.php");
	}
?>
</div>
</div>
 </div>
</div>
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
</body>
</html>