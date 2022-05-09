<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!--deepthi-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font/font-awesome.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body class="bgimg">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">
    <div class="text">Login Form</div>
      <form action="" method="post">
         <div class="field">
            <i class="fa-solid fa-envelope"></i>
             <input type="text" name="email" placeholder="email" required>
         </div>
         <div class="field">
             <i class="fa-solid fa-lock"></i>
             <input type="password" name="password" placeholder="password" required>
         </div>
         <div class="btn">
               <button type="submit" name="submit">Sign In</button>
         </div>
         <div><p align="center">don't have an account? <a href="register.php">register now</a></p> </div>
      <!-- <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box" id="myInput">
      
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="register.php">register now</a></p> -->
   </form> 
  </div>
</div>
<script>
    function myFunction()
    {
        var x=document.getElementById("myInput");
        var y=document.getElementById("hide1");
        var z=document.getElementById("hide2");
        if(x.type==="password")
        {
            x.type="text";
            y.style.display="block";
            z.style.display="none";
            
        }
        else{
            x.type="password";
            y.style.display="none";
            z.style.display="block";
        }
    }
</script>



</body>
</html>



