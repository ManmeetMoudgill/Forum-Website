<?php
include './_db.php';
$login=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $sql="SELECT * FROM `users` WHERE `Email`='$email'";
    $result=mysqli_query($con,$sql);
    
    /* check whether the email is already exist */
    /* check the number of row if it exist */
    $num_rows=mysqli_num_rows($result);
    if($num_rows==1){
        $row=mysqli_fetch_assoc($result);
        $username=$row['Username'];
        if(password_verify($password,$row['Password'])){
            session_start();
            $_SESSION['loggedIn']=true;
            $_SESSION['Id']=$row['IdUser'];
            $_SESSION['username']=$username;
            header("Location:/NewForumWebsite/index.php?login=true");
        }else{
            header("Location:/NewForumWebsite/index.php?credentials=false");
        }
    }else{
        header("Location:/NewForumWebsite/index.php?gosignUpFirst=true");
    }
}








?>