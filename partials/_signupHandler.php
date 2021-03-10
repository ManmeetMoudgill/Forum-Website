<?php

include './_db.php';
$showError="false";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $phoneNumber=$_POST['phoneNumber'];
    $password=$_POST['password'];
    $cpassword=$_POST['confirmPassword'];
   
    $sql="SELECT * FROM `users` WHERE `Email`='$email'";
    $result=mysqli_query($con,$sql);
    
    /* check whether the email is already exist */
    /* check the number of row if it exist */
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        header("Location:/NewForumWebsite/index.php?EmailExist=true");
    }else{
        if($password===$cpassword){
            /* Encrypting the plain password into hash using an alogritm */
            $hashPassword=password_hash($password,PASSWORD_BCRYPT);
            $hashCPassword=password_hash($cpassword,PASSWORD_BCRYPT);
            $sql1="INSERT INTO `users`(`Username`, `Email`, `Password`, `CPassword`, `PhoneNumber`) VALUES ('$username','$email','$hashPassword','$hashCPassword','$phoneNumber')";
            $result1=mysqli_query($con,$sql1);
            if($result1){
               header("Location:/NewForumWebsite/index.php?loginSuccess=true");
               exit();
            }
        }else{
           ?>
           <script>
           alert("Password do not Match 😢 ")
           </script>
           <?php
           header("Location:/NewForumWebsite/index.php?PasswordMatch=false");
        }
    }



}



?>