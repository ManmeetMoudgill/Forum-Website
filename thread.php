<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
    include 'partials/_links.php';
    include 'partials/_db.php';
    error_reporting(E_ALL);
    ?>


    <title>Welcome to IDiscuss-Forum Website</title>
</head>

<body>
    <!-- getting the info from threads table using thread_id -->
    <?php
    include 'partials/_header.php';
   $id=$_GET['threadId'];
   $sql="SELECT * FROM `threads` WHERE `threads_id`=$id";
   $result=mysqli_query($con,$sql);
   while($row=mysqli_fetch_assoc($result)){
       $threads_title=$row['threads_title'];
       $threads_desc=$row['threads_description'];
       $user_id=$row['threads_user_id'];

       /* getting the user info from user tabel by using foreign key of a thread table */
       $sqlQueryUsername="SELECT `Username` from `users` WHERE `IdUser`='$user_id'";
       $result2=mysqli_query($con,$sqlQueryUsername);
       $data=mysqli_fetch_assoc($result2);
       $postedBy=$data['Username'];
       

       
   }
    
  ?>
  <?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $thread_id=$_GET['threadId'];
    $comment_content=$_POST['commentArea'];
    $user_name1=$_POST['sno'];
   
    $query="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `CurrentTime`) VALUES ('$comment_content', '$thread_id', '$user_name1', current_timestamp())";
    $risultato=mysqli_query($con,$query);
    if($risultato){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success</strong>Your comment has been added succesfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}

?>
    <!-- showing the data into our page that we fetched from database  -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $threads_title; ?></h1>
            <p class="lead"><?php echo $threads_desc; ?></p>
            <hr class="my-4">
            <p>This is peer to peer sharing forum with each other.
                No Spam / Advertising / Self-promote in the forums is not allowed ...
                Do not post “offensive” posts, links or images. ...
                Remain respectful of other members at all times.
                Do not PM users asking for help. ...
                Do not cross post questions. ...
            </p>
            <p><b>Posted by <?php echo $postedBy;?></b></p>
        </div>
    </div>
<?php
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
    echo '<div class="container">
        <h1>Post an comment</h1>
        <form action="'. $_SERVER["REQUEST_URI"].'" method="POST">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="commentArea" name="commentArea" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["Id"].'">
            </div>
            <button type="submit" class="btn btn-success">Post a comment</button>
        </form>';

}else{
    echo ' <div class="container d-flex ">
    <h2 class="mx-0">Login to be able to Post an Comment ✏ </h2>
    <a  data-toggle="modal" data-target="#LoginModal" class="btn btn-primary mx-2 btn-lg" href="#" role="button">Log In</a>
 </div>';
}
?>

        <!-- submitting the data which is basically question  -->

    </div>
    
    <div class="container my-4 mb-2">
        <h2>Discussions</h2>
       
         <?php
        $id=$_GET['threadId'];
        $sql1="SELECT * FROM `comments` WHERE `thread_id`=$id";
        $result1=mysqli_query($con,$sql1);
        $noResult=true;
        while($row1=mysqli_fetch_assoc($result1)){
        $noResult=false;
        $comment_id=$row1['comment_id'];
        $comment_content=$row1['comment_content'];

       
        
        

        /* In order to stay away from attacks we need to convert the inserted tags into a normal string */
        $comment_content=str_replace("<","&lt",$comment_content);
        $comment_content=str_replace(">","&gt",$comment_content);
        $time=$row1['CurrentTime'];


        /* getting the information in order to know posted the comment */
        $thread_user_id=$row1['comment_by'];
        $sqlusername="SELECT `Username` FROM `users` WHERE `IdUser`='$thread_user_id'";
        $risultato1=mysqli_query($con,$sqlusername);
        $data=mysqli_fetch_assoc($risultato1);
     
        echo '<div class="media my-3">
        <img class="mr-3" src="./Images/question-1.jpg" width="50px" alt="Generic placeholder image">
        <div class="media-body">
        <p class="font-weight-bold my-2">Commented By: '. $data['Username'].' at '.$time.'</p>
            '.$comment_content.'
        </div>
       </div>';
 }
 if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No comments found</p>
      <p class="lead">Your are the first one to comment</p>
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