<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Welcome to IDiscuss-Forum Website</title>
    <style>
    .container{
        min-height:100vh;
    }
    .stickFooter{
        position:sticky;
    
    }
    </style>
   
</head>

<body>
<?php 
/* include 'partials/_links.php'; */
include 'partials/_db.php';
include 'partials/_header.php';
  ?>

<div class="container my-3">
<h1>Search Results for <em>"<?php echo $_GET['Query'];?>"</em></h1>
 <?php
 $query=$_GET['Query'];
 $sql="SELECT * from threads WHERE MATCH(threads_title,threads_description) against('$query')";
$resultNotfound=true;
 $result=mysqli_query($con,$sql);
 while($info=mysqli_fetch_assoc($result)){
     $resultNotfound=false;
     $title=$info['threads_title'];
     $desc=$info['threads_description'];
     $id=$info['threads_id'];
     $url="/NewForumWebsite/thread.php?threadId=".$id;
    echo '<div class="result">
    <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
    <p>'.$desc.'</p>
    </div>
    </div>';
 }
 if($resultNotfound){
     echo '<div class="jumbotron">
     <h1 class="display-4">Result not found</h1>
     <hr class="my-4">
     <p class="lead">Suggestions:
     <li>Make sure all words are spelled correctly</li>
     <li>Try different Keywords</li>
     <li>Try more general Keywords</li>
     <li>Sorry there is not any result related to your query.</li>
     </p>
 </div>';
 }
 
?>

        <?php  include 'partials/_footer.php';?>
        
        <!-- Optional JavaScript; choose one of the two! -->


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <!-- 
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
        </script>

</body>

</html>