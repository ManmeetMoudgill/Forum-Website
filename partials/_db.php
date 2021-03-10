<?php
$username="root";
$server="localhost";
$password="";
$db="idiscuss";
$con=mysqli_connect($server,$username,$password,$db);
if(!$con){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong>Connection failed with database.Make sure you server is on.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}



?>
<!-- connecting to database -->