<?php

$con=mysqli_connect("localhost","root","","eCommerce");
 if(mysqli_connect_errno())
 {
 echo "Failed to connect to the database:" .mysqli_connect_error();
 }
 //getting the user Ip Address
 function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
//creating the shopping cart
 function cart(){
 	if (isset($_GET['add_cart'])) {
 		global $con;

 		$ip=getIp();

 		$pro_id=$_GET['add_cart'];

 		$check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";

 		$run_check=mysqli_query($con,$check_pro);
 		if (mysqli_num_rows($run_check)>0) {
 			echo "";
 		}

 		else {

 			$insert_pro="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
 			$run_pro=mysqli_query($con, $insert_pro);
 			echo "<script>window.open('index.php','_self')</script>";
 		}
 		
 	}
 }
//getting the total items added to the shopping cart
   function total_items(){
      if (isset($_GET['add_cart'])) {
      	global $con;
      	$ip=getIp();
      	$get_items="select * from  cart where ip_add='$ip'";
      	$run_items=mysqli_query($con, $get_items);
      	//to count number of items
      	$count_items=mysqli_num_rows($run_items);
      }
      //total should be updated whether user added to cart or no total should show number fom 0
      else{
      	global $con;
      	$ip=getIp();
      	$get_items="select * from  cart where ip_add='$ip'";
      	$run_items=mysqli_query($con, $get_items);
      	//to count number of items
      	$count_items=mysqli_num_rows($run_items);
      }
      echo $count_items;


   }
 //getting total price of the item in the shopping cart
   function total_price(){

   	  $total=0;
      global $con;
      

      $ip=getIp();
      $sel_price="select * from cart where ip_add='$ip'";
      $run_price=mysqli_query($con,$sel_price);

      while ($p_price=mysqli_fetch_array($run_price)) {
//getting specific details of an item from the database

      	$pro_id=$p_price['p_id'];
      	//making relationship between two tables
      	$pro_price="select * from products where product_id='$pro_id'";
      	$run_pro_price=mysqli_query($con,$pro_price);
      
      while ($pp_price=mysqli_fetch_array($run_pro_price)){

      	$product_price=array($pp_price['product_price']);
      	//to sum the values in the array

      	$values=array_sum($product_price);
      	$total +=$values;  

      }

    }
      echo "Ksh. " .$total;

   }

//getting categories
function getcats(){
  global $con;
  $get_cats="select * from categories";

  $run_cats=mysqli_query($con,$get_cats);

  while ($row_cats=mysqli_fetch_array($run_cats)) {

  	$cat_id=$row_cats['cat_id'];

  	$cat_title=$row_cats['cat_title'];

  	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
  }
}
//getting Brands
function getbrands(){
  global $con;
  $get_brands="select * from brands";

  $run_brands=mysqli_query($con,$get_brands);

  while ($row_brands=mysqli_fetch_array($run_brands)) {

  	$brand_id=$row_brands['brand_id'];

  	$brand_title=$row_brands['brand_title'];

  	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
  }
}
function getpro(){
	if (!isset($_GET['cat'])) {

		if (!isset($_GET['brand'])) {
		
		
		
	

	global $con;
	$get_pro="select * from products order by RAND() LIMIT 0,6";
	$run_pro=mysqli_query($con,$get_pro);

	while ($row_pro=mysqli_fetch_array($run_pro)) {

		$pro_id=$row_pro['product_id'];

		$pro_cat=$row_pro['product_cat'];

		$pro_brand=$row_pro['product_brand'];

		$pro_title=$row_pro['product_title'];

		$pro_price=$row_pro['product_price'];

		$pro_desc=$row_pro['product_desc'];

		$pro_image=$row_pro['product_image'];

		echo "
		   <div id='single_product'>

		     <h3>$pro_title</h3>
		     <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
		     <p><b>Price: Ksh.$pro_price</b></p>
		     <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>

		     <a href='index.php?add_cart=$pro_id'<button style='float:right'>Add to cart</button></a>

		   </div>


		";

	  }
	 }
   }
}
function getcatpro(){
	if (isset($_GET['cat'])) {

		$cat_id=$_GET['cat'];

	global $con;
	$get_cat_pro="select * from products where product_cat='$cat_id'";
	$run_cat_pro=mysqli_query($con,$get_cat_pro);
	$count_cats=mysqli_num_rows($run_cat_pro);
	 if ($count_cats==0) {
	 	echo "<h4 style='padding:20px;'>There are no products in this category!</h4>";
	 }
      
	while ($row_cat_pro=mysqli_fetch_array($run_cat_pro)) {

		$pro_id=$row_cat_pro['product_id'];

		$pro_cat=$row_cat_pro['product_cat'];

		$pro_brand=$row_cat_pro['product_brand'];

		$pro_title=$row_cat_pro['product_title'];

		$pro_price=$row_cat_pro['product_price'];

		$pro_desc=$row_cat_pro['product_desc'];

		$pro_image=$row_cat_pro['product_image'];

		echo "
		   <div id='single_product'>

		     <h3>$pro_title</h3>
		     <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
		     <p><b>Ksh.$pro_price</b></p>
		     <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>

		     <a href='index.php?pr0_id=$pro_id'<button style='float:right'>Add to cart</button></a>

		   </div>


		";

	  }

	 
   }
}
function getbrandpro(){
	

		if (isset($_GET['brand'])) {
		
		
		
	    $brand_id=$_GET['brand'];

	global $con;
	$get_brand_pro="select * from products where product_brand='$brand_id'";
	$run_brand_pro=mysqli_query($con,$get_brand_pro);
	 $count_brands=mysqli_num_rows($run_brand_pro);
	  if ($count_brands==0) {
	  	echo "<h5>There are no products in this brand!</h5>";
	  }

	while ($row_brand_pro=mysqli_fetch_array($run_brand_pro)) {

		$pro_id=$row_brand_pro['product_id'];

		$pro_cat=$row_brand_pro['product_cat'];

		$pro_brand=$row_brand_pro['product_brand'];

		$pro_title=$row_brand_pro['product_title'];

		$pro_price=$row_brand_pro['product_price'];

		$pro_desc=$row_brand_pro['product_desc'];

		$pro_image=$row_brand_pro['product_image'];

		echo "
		   <div id='single_product'>

		     <h3>$pro_title</h3>
		     <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
		     <p><b>Ksh.$pro_price</b></p>
		     <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>

		     <a href='index.php?pr0_id=$pro_id'<button style='float:right'>Add to cart</button></a>

		   </div>


		";

	  }
	 }
   
}


?>