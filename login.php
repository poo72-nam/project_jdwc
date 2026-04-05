<?php
session_start();
$errors = [
  'login'=>$_SESSION['login_error'] ?? '',
  'register'=>$_SESSION['register_error'] ?? '',
  'forgot'=>$_SESSION['forgot_error'] ?? ''];
   $activeform = $_SESSION['active_form'] ?? 'login' ;

   session_unset();
   function showError($error){
    return !empty($error) ? "<p class='error-message'>$error</p>" :'';
   }
   function isActiveForm($formName,$activeForm){
    return $formName===$activeForm ? 'active' : '';
   }
?>



 


<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Medix Store</title>
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div class="main">
      <div class="container">
        <h2>Welcome to </h2>
          <h1>MediX Store</h1>
        
        <p>
          Your trusted pharmacy partner.<br />
          Quality medicines, reliable service, and care you can trust.
        </p>
      </div>
      <div class="login">
        <br>
        <div class="content <?= isActiveForm('login',$activeForm); ?>" >
          

          <form action="login_register.php" method="post">
            <h2>Login</h2>
            <?=showError($errors['login']); ?>
            <div class="input">
              <input type="email" name ="email" placeholder="user_email" required />
            </div>
            <div class="input">
              <input type="password" name="password" placeholder="password" required />
            </div>
            <div class="option">
              <label><input type="checkbox" required > Remember me</label>
              <!-- <a href="#">Forgot Password?</a> -->
               <a href="#" onclick="show('content2')">Forgot Password?</a>
            </div>
            <button type="submit" name="login" class="log">Login</button>
          </form>
          <div class="register">
           Don't have an account? <a onclick="show('content1')">Register</a> 
          </div>
        </div>

        
         <div class="content1 hidden <?= isActiveForm('register',$activeForm); ?>">
          
          <form action="login_register.php" method="post">
            <?=showError($errors['register']); ?>
            <h2>Register</h2>
            <div class="input1">
              <input type="text" name="name"  placeholder="username" required />
            </div>
             <div class="input1">
              <input type="email" name="email" placeholder="Email Id" required />
            </div>
            <div class="input1">
              <input type="password" name="password" placeholder="password" required />
            </div>
            <div class="input1">
              <input type="password" name="confirm" placeholder="Confirm password" required />
            </div>
            <span id="error" style="color:red;"></span><br><br>
            <div class="terms">
              <label><input type="checkbox" >I agree to the terms & conditions.</label>
            </div>
            <button type="submit" name="register" class="reg">Register</button>
          </form>
           <div class="register">
           Already have an account? <a onclick="show('content')">Login</a> 
          </div>
        
          </div>

          <!-- ---------------------------------- -->
         
          <div class="content2  hidden <?= isActiveForm('forgot',$activeForm); ?>">
          <form action="login_register.php" method="post">
           
          <h2>Forgot Password</h2>
            <?= showError($errors['forgot']); ?>
          <div class="input2">
            <input type="email" name="email" placeholder="Enter your registered email" required />
         </div>
        <button type="submit" name="forgot" class="reset">Send OTP</button>
        </form>
       <div class="register">
        Remembered your password? <a onclick="show('content')">Login</a>
       </div>
       </div>

     </div>
    </div>
    <script src="login.js"></script>
  </body>
</html>
