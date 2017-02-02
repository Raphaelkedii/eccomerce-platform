<?php
    
   include("includes/db.php");
   
?>

<div>
  <form method="post" action="">

    <table width="auto" bgcolor="skyblue">

        <tr>
           <td colspan="4"><h2>Login or Register to Buy!</h2></td>
        </tr>

        <tr>
        	<td align="right"><b>Email:</b></td>
        	<td><input type="text" name="email" placeholder="enter email" required="" /></td>
        </tr>

        <tr>
        	<td align="right"><b>Password:</b></td>
        	<td><input type="Password" name="pass" placeholder="enter Password" required=""></td>
        </tr>

        <tr align="center">
        	<td colspan="3"><a href="checkout.php?forgot_pass"><b>Forgot Password?</b></a></td>
        </tr>

        <tr align="center" >
        	<td colspan="4"><input type="submit" name="login" value="Login"></td>
        </tr>

    </table>
         <h2 style="float: right; padding-right: 20px;"><a href="customer_register.php" style="text-decoration: none;">New? Register Here</a></h2>
</div>

<?php
   if (isset($_POST['login'])) {
       $c_email=$_POST['email'];
       $c_pass=$_POST['pass'];

       $sel_c="select * from customers where customer_email='$c_email' AND customer_pass='$c_pass'";
       $run_c=mysqli_query($con,$sel_c);

       $check_customer=mysqli_num_rows($run_c);

       if($check_customer==0){
        echo "<script>alert('password or email is incorrect please try again!')</script>";
        exit();
       }

       $ip=getIp();

        $sel_cart="select * from cart where ip_add='$ip'";

        $run_cart=mysqli_query($con,$sel_cart);

        $check_cart=mysqli_num_rows($run_cart);

      if($check_customer>0 AND $check_cart==0){

         $_SESSION['customer_email']=$c_email;

          echo "<script>alert('You logged in successfully , Thanks!')</script>";
          echo "<script>window.open('customer/my_account.php','_self')</script>";
      }
      else{
        $_SESSION['customer_email']=$c_email;
        echo "<script>alert('You logged in successfully , Thanks!')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
      }
   }
?>





