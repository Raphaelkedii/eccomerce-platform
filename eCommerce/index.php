<!DOCTYPE>
<?php
session_start();
 include("functions/functions.php");  
?>

<html>
<head>
	<title>My Online Shop</title>
  <link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>
  <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
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
          	    <form method="get" action="results.php" enctype="multipart/form-data">
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
               <div id="sidebar_title">Random products

                

               </div>
             </div>


             <div id="content_area" >
             <?php cart();?>
             <div id="shopping_cart">
                <span style="padding: 5px;font-size:20px;float:right;line-height: 45px;">
                <?php 
                  if (isset($_SESSION['customer_email'])){
                     global $con;
                     $ip=getIp();
                    echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>";
                  }
                  else{
                    echo "<b>Welcome Guest:</b>" . "<b style='color:yellow;'>Your</b>";
                  }

                ?>
                     <b style="color: yellow">Shopping Cart -</b>Total items:  <b style="color: blue"><?php total_items(); ?></b> Total price:  <b style="color: red"><?php total_price(); ?></b>
                     <a href="cart.php" style="color: yellow">Go to Cart</a>

                  <?php
                     if (!isset($_SESSION['customer_email'])) {
                       echo "<a href='checkout.php'>Login</a>";

                     }
                      else {
                        echo "<a href='logout.php'>Logout</a>";
                      }

                  ?>
                </span>
             </div>
            
                 <div id="Products_box">
                   <?php getpro();?>
                   <?php getcatpro();?>
                   <?php getbrandpro();?>
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