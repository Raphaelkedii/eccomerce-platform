<!DOCTYPE>
<?php
 include("functions/functions.php");  
?>

<html>
<head>
	<title>My Online Shop</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>
</head>
<body>
  <div class="main_wrapper">

       <div class="Header_wrapper">

        <a href="index.php"><img id="logo" src="images/logo2.png"/></a>
        <img id="banner" src="images/f4.jpg"/>




          

       </div>
       <div class="menubar" >
          	<ul id="menu" >
          		<li><a href="index.php">Home</a></li>
          		<li><a href="all_products.php">All Products</a></li>
              <li><a href="customer/my_account.php">My Account</a></li>
              <li><a href="cart.php">Shopping Cart</a></li>
              <li><a href="customer_register.php">Sign Up</a></li>
          	</ul>
          	<div id="form" >
          	    <form method="GET" action="results.php" enctype="multipart/form-data">
          	    	<input type="text" name="user_query" placeholder="search a product" />
          	    	<input type="submit" name="search" value="search" />
          	    </form>
          		
          	</div>



          </div>
       <div class="content_wrapper">


     
             <div id="sidebar" >
               <div id="sidebar_title" >CATEGORIES</div>
               <ul id="cats" >
                <?php
                   getcats();
                ?>
               </ul>
               <div id="sidebar_title" >BRANDS</div>
               <ul id="cats" >
                 <?php
                   getbrands();
                ?>
               </ul>
             </div>


             <div id="content_area" >
             <div id="shopping_cart">
                <span style="padding: 5px;font-size:20px;float:right;line-height: 45px;">
                  welcome our esteemed customer! <b style="color: yellow">Shopping Cart -</b>Total items:<b style="color: blue"><?php total_items(); ?></b> Total price:<b style="color: red"><?php total_price(); ?></b>
                  <a href="cart.php" style="color: yellow">Go to Cart</a>
                </span>
             </div>
                 <div id="Products_box">
    <?php

     if (isset($_GET['search'])) {

      $search_query=$_GET['user_query'];
       
     

    $get_pro="select * from products where product_keywords like '%$search_query%'";
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
         <p><b>Ksh.$pro_price</b></p>
         <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>

         <a href='index.php?pr0_id=$pro_id'<button style='float:right'>Add to cart</button></a>

       </div>


    ";

    }
  }
    ?>
                 </div>
             </div>

        </div>
       <div id="footer" >
         <h1><a style="text-decoration: none" href="#">About Us |</a><a style="text-decoration: none" href="#">Website Terms of Use |</a><a style="text-decoration: none" href="#">Privacy Policy |</a><a style="text-decoration: none" href="#">Contact Us</a></h1>
         <h2 style="text-align: center;padding-top: 40px;">&copy; 2016 by www.onGlobetechnologies.com . All right reserved</h2>
       </div>
  	




  </div>
</body>
</html>