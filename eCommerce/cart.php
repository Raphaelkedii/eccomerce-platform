<!DOCTYPE>
<?php
session_start();

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
                  welcome our esteemed customer! <b style="color: yellow">Shopping Cart -</b>Total items:  <b style="color: blue"><?php total_items(); ?></b> Total price:  <b style="color: red"><?php total_price(); ?></b>
                  <a href="index.php" style="color: yellow">Go to Shop</a>


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
                   <form action="" method="post" enctype="multipart/form">
                   <table align="center" width="auto" bgcolor="skyblue">
                      
                     <tr align="center">
                        <th>Remove</th>

                        <th>Product(s)</th> 

                        <th>Quantity</th><br>

                        <th>Total Price</th>
                       
                     </tr>
      <?php
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

        $product_title=$pp_price['product_title'];

        $product_image=$pp_price['product_image'];

        $single_price=$pp_price['product_price'];
        //to sum the values in the array

        $values=array_sum($product_price);
        $total +=$values;  

      ?>
      <tr align="center">
        <td><input type="checkbox" name="remove['']" value="<?php echo $pro_id; ?>"></td>
        <td><?php echo $product_title;?><br>
        <img src="admin_area/product_images/<?php echo $product_image;?>" width="100" height="100">
        </td>
        <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION ['qty']; ?>"/></td>


        <?php
          if (isset($_POST['update_cart'])) {
            global $con;


             $qty=$_POST['qty'];
             $update_qty="update cart set qty='$qty'";
             $run_qty=mysqli_query($con, $update_qty);

             $_SESSION['qty']=$qty;

             $total=$total*$qty;
  
          }


        ?>
        <td><?php echo "Ksh" .$single_price ?></td>
      </tr>
      

      <?php } } ?>
      <tr align="right">
         <td colspan="5"><b>Sub Total: </b></td>
         <td><?php echo "Ksh" . $total ?></td>
      </tr>

      <tr align="center">
         <td colspan="1"><input type="submit" name="update_cart" value="Update Cart"></td>
         <td><input type="submit" name="continue" value="Continue Shopping"></td>
         <td><button><a style="text-decoration: none;" href="checkout.php">Checkout</a></button></td>
      </tr>

                   </table>
                     
                   </form>
            <?php
            function updatecart(){
               global $con;
               $ip=getIp();


              if (isset($_POST['update_cart'])) {

                 foreach($_POST['remove'] as $remove_id) {

                    $delete_product="delete from cart where p_id='$remove_id' AND ip_add='$ip'";

                    $run_delete=mysqli_query($con, $delete_product);
                    if ($run_delete) {

                       echo "<script>window.open('cart.php','_self')</script>";
                    }
                 }
              }

              
               echo @$up_cart=updatecart();

               }
               
               if (isset($_POST['continue'])) {
                 echo "<script>window.open('index.php','_self')</script>";
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