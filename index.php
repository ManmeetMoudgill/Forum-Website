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
   
</head>

<body>
    <?php include 'partials/_header.php';
  ?>

    <!-- slider 1 -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="1000">
                <img src="http://localhost/NewForumWebsite/Images/slider-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="2000">
                <img src="http://localhost/NewForumWebsite/Images/slider-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="2000">
                <img src="http://localhost/NewForumWebsite/Images/slider-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>




    <!-- create a div in which we gonna put our categories pulled form database  -->
    <div class="container">
        <h2 class="text-center">IDiscuss Categories</h2>z
        <div class="row">
    <?php
        include 'partials/_db.php';
        $sql="SELECT * FROM `categories`";
        $result=mysqli_query($con,$sql);
        /* we gonna use while loop to iterate the categoriess*/
        /* inside while loop i am creating two variables to store catrgorie name and categorie description which i am gonna use in echo string */
        while($row=mysqli_fetch_assoc($result)){
          $categorieName=$row['categories_name'];
          $categorieDesc=$row['categories_description'];
          $id=$row['categories_id'];
          echo '<div class="col-md-4 my-2">
              <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="https://source.unsplash.com/500x400/?'.$categorieName.'coding,computer,mobiles" alt="Card image cap">
                  <div class="card-body">
                      <h5 class="card-title"><a href="_threadList.php?catId='.$id.'">'.$categorieName.'<a/></h5>
                      <p class="card-text">'. substr($categorieDesc,0,90).'</p>
                      <a href="_threadList.php?catId='.$id.'" class="btn btn-primary">View Threads</a>
                  </div>
              </div>
          </div>';
        }
        /* if have used substring to get particular number of character in a string for instance in this case i am getting only 90 characters */
        ?>
    </div>



        <!-- including footer -->
        
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