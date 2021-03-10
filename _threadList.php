<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
    include 'partials/_db.php';
    include 'partials/_links.php';
    
    ?>


    <title>Welcome to IDiscuss-Forum Website</title>
</head>

<body>
    <?php
    include 'partials/_header.php';
   
   $id=$_GET['catId'];
   $sql="SELECT * FROM `categories` WHERE `categories_id`=$id";
   $result=mysqli_query($con,$sql);
   while($row=mysqli_fetch_assoc($result)){
       $categories_name=$row['categories_name'];
       $categories_desc=$row['categories_description'];
       
   }
    
?>
    <?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $id=$_GET['catId'];
    $title=$_POST['title'];
    $description=$_POST['description'];

    /* In order to stay away from attacks we need to convert the inserted tags into a normal string */
    $title=str_replace("<","&lt",$title);
    $title=str_replace(">","&gt",$title);

    /* In order to stay away from attacks we need to convert the inserted tags into a normal string */
    $description=str_replace("<","&lt",$description);
    $description=str_replace(">","&gt",$description);
    $user_name=$_POST['sno'];
    
    $sql2="INSERT INTO `threads` (`threads_title`, `threads_description`, `threads_cat_id`, `threads_user_id`, `CurrentTineDate`) VALUES ('$title', '$description', '$id', '$user_name', current_timestamp())";
    $result2=mysqli_query($con,$sql2);
    if($result2){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong>Your thread has been added!.please wait community to respond
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    
}
?>

    <!-- getting the data from categoris table in order to show into our page -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $categories_name; ?> Forum</h1>
            <p class="lead"><?php echo $categories_desc; ?></p>
            <hr class="my-4">
            <p>This is peer to peer sharing forum with each other.
                No Spam / Advertising / Self-promote in the forums is not allowed ...
                Do not post “offensive” posts, links or images. ...
                Remain respectful of other members at all times.
                Do not PM users asking for help. ...
                Do not cross post questions. ...
            </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

<?php
session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
  
    echo '
    <div class=" my-5 container">
    <h1>Start an Discussion</h1>
    <form action="'.$_SERVER["REQUEST_URI"].'"method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="textHelp"
            placeholder="Enter email">
        <small id="textHelp" class="form-text text-muted">We ll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        <input type="hidden" name="sno" value="'.$_SESSION["Id"].'">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>';
}else{
   echo ' <div class="container d-flex ">
   <h2 class="mx-0">Login to be able to start a Discussion ✏ </h2>
   <a  data-toggle="modal" data-target="#LoginModal" class="btn btn-primary mx-2 btn-lg" href="#" role="button">Log In</a>
</div>';
}
?>

   

    <!-- submitting the data which is basically question  -->

    
    <div class="container my-4 mb-2">
        <h2>Browse Questions</h2>
        <!-- getting the data from table threads using thread_cat_id in showing into our page -->
        <?php
        $id=$_GET['catId'];
        $sql1="SELECT * FROM `threads` WHERE `threads_cat_id`=$id";
        $result1=mysqli_query($con,$sql1);
        $noresult=true;
        while($row1=mysqli_fetch_assoc($result1)){
        $noresult=false;
        $thread_id=$row1['threads_id'];
        $thread_title=$row1['threads_title'];
        $thread_des=$row1['threads_description'];
        $time=$row1['CurrentTineDate'];

        /* getting user information in order to who started the discussion */
        $thread_user_id=$row1['threads_user_id'];
        $sqlusername="SELECT `Username` FROM `users` WHERE `IdUser`='$thread_user_id'";
        $risultato1=mysqli_query($con,$sqlusername);
        $data=mysqli_fetch_assoc($risultato1);
     
        echo '<div class="media my-3">
        <img class="mr-3" src="./Images/question-1.jpg" width="50px" alt="Generic placeholder image">
        <div class="media-body">
        <p class="font-weight-bold my-2">Asked By: '.$data["Username"].' at '.$time.'</p>
            <h5 class="mt-0"><a href="thread.php?threadId='.$thread_id.'">'.$thread_title.'</a></h5>
            '.$thread_des.'
        </div>
       </div>';
 }
if($noresult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No Threads found</p>
      <p class="lead">Your are the first one to ask a question</p>
    </div>
  </div>';
}
include 'partials/_footer.php';
?>

        <!-- second div -->


        <!-- Optional JavaScript -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>