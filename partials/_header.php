<?php
session_start();
include 'partials/_db.php';
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="http://localhost/NewForumWebsite/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

      $sqlQuerycate="SELECT categories_id, categories_name FROM `categories`LIMIT 5";
      $risultatoQuery=mysqli_query($con,$sqlQuerycate);
      while($row=mysqli_fetch_assoc($risultatoQuery)){
        echo '<a class="dropdown-item" href="/NEWFORUMWEBSITE/_threadList.php?catId='.$row['categories_id'].'">'.$row['categories_name'].'</a>';
      }
      
    echo '</div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1">Contact</a>
      </li>
    </ul>';
    
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){

      echo '
      <p class=" my-2 text-light">Welcome '. $_SESSION['username'].'</p>
      <div class="row mx-1">
      <form class="d-flex" method="get" action="./search.php">
        <input class="form-control me-2" name="Query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success text-light" type="submit">Search</button>
        <button class=" buttone btn btn-outline-success mx-2" type="button"><a class=" anchorHref text-decoration-none text-light"href="/NewForumWebsite/partials/_logout.php">Logout</a></button>
        </form>  
        </div>';     
    }else{
      echo '
      <form class="d-flex" method="get" action="./search.php">
      <input class="form-control me-2" name="Query" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success text-light" type="submit">Search</button>
      </form> 
      </div>
      <button type="button" class="mx-1 btn btn-success" data-toggle="modal" data-target="#LoginModal">
       Login
       </button>
       <button type="button" class="mx-1 btn btn-success" data-toggle="modal" data-target="#signupModal">
        SignUp
       </button>';

    }
echo '</div>
</div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
error_reporting(E_ALL ^ E_NOTICE); 
if(isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == true){
  $alert= '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>Sign up succesfull.You can now login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert;
      if($alert!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
}else if(isset($_GET['EmailExist']) && $_GET['EmailExist'] == true){
  $alert1= '<div class="alert my-0 alert-warning alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>Email Already Exist,Seems Like you are already regisetered.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert1;
      if($alert1!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
}
else if(isset($_GET['PasswordMatch']) && $_GET['PasswordMatch'] == false){
  $alert3= '<div class="alert my-0 alert-warning alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>Password do not Match!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert3;
      if($alert3!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
} 
else if(isset($_GET['login']) && $_GET['login'] == true){
  $alert4= '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>You are now logged In!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert4;
      if($alert4!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
} 
else if(isset($_GET['credentials']) && $_GET['credentials'] == false){
  $aler5= '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong> Unable to login.Wrong Crendetials!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert5;
      if($alert5!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
} 
else if(isset($_GET['gosignUpFirst']) && $_GET['gosignUpFirst'] == true){
  $alert6= '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>Credentials not found Signup first!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert6;
      if($alert6!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
} 
else if(isset($_GET['loggedOut']) && $_GET['loggedOut'] == true){
  $alert7= '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong>You are logged out now!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      echo $alert7;
      if($alert7!=""){
        ?>
    <script>
    setTimeout(() => {
        window.location = "./index.php";
    }, 2000)
    </script>
    <?php
    }
} 




?>