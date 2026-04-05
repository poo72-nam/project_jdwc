<?php

session_start();
require_once 'config.php';



if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    //password==cofirm
    if($password !== $confirm){
       



        $_SESSION['register_error'] = "Passwords do not match!";

        $_SESSION['active_form'] = 'register';
        header("Location: login.php");
        exit();
    }

    //password encrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     //check email 
    $checkEmail = $conn->query("SELECT email FROM user WHERE email='$email'");

    if($checkEmail->num_rows > 0){
      $_SESSION['register_error'] = 'Email is already registered!';
      $_SESSION['active_form']= 'register';
      header("Location: login.php");
      exit();  
    }
    else {
        $conn->query("INSERT INTO user (name,email,password) VALUES ('$name','$email','$hashed_password')");
    }
    header("Location: login.php");
    exit();
    
}



if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $result = $conn->query("SELECT * FROM user WHERE email='$email'");
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            $_SESSION['name']=$user['name'];
            $_SESSION['email']=$user['email'];
             header("Location:home.php");
              exit();
        }
       
       
    }
    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: login.php");
     exit();
}
?>