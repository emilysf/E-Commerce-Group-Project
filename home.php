<?php
$con = mysql_connect("sulley.cah.ucf.edu","ka578143","DancinG#93");
if (!$con) {
	die("Can not Connect: " . mysql_error());
}
mysql_select_db("ka578143",$con);

$sql = 'SELECT * FROM wednesday where productID=659';
$myData = mysql_query($sql,$con);
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">



<title>Wednesday Home</title>

<style>
@import url('css/bootstrap.css');
@import url('css/bootstrap.min.css');
@import url('css/full-width-pics.css');
@import url('css/styles.css');
@import url(https://fonts.googleapis.com/css?family=Montserrat);
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<?php include_once("analyticstracking.php") ?>
 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
          <div class="mobilelogo">
            <a href="home.php"><img src="img/wednesday_logo1.png" alt=""></a>
            </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              
               <!-- <a class="navbar-brand" href="#">Start Bootstrap</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="logo">
            <div class="col-lg-4"><a href="home.php"><img src="img/wednesday_logo1.png" alt=""></a></div>
            </div>
            <div class="col-lg-8">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="home.php">Home</a>
                        	
                    </li>
                    <li>
                        <a href="womenscatalog.php">Women</a>
                    </li>
                    <li>
                        <a href="menscatalog.php">Men</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="client.php">Sign In</a>
                    </li>
                 <li>
                         <a href="cart.php"><img src="img/shoppingbag.png" alt=""></a>
                    </li>
                </ul>
                     <form class="navbar-form" role="search" action="womenscatalog.php" enctype="multipart/form-data" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
           
           <!-- <a href="#"><img src="img/shoppingbag.png"></a>-->
            </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

   
    <div class="container">
	<div class = "banner">
    	<img class="img-responsive img-center" src="img/clothes.png" alt="">
    </div>
    </div>
    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="section-heading">Currently On Sale</h1>
                     <?php
                    while ($row = mysql_fetch_array($myData))  
                    echo'
                    <div class="col-md-12">
                        <div class="thumbnail">
                            <a href="product_details.php?id='.$row['productID'].'"><img src="'.$row['productImage'].'" alt="'.$row['productImage'].'"></a>
                            <div class="caption">
                                <h2 class="pull-right" style="color:#d824c9;">'.$row['price'].'</h2>
                                <h2><a href="product_details.php?id='.$row['productID'].'">'.$row['productName'].'</a>
                                </h2>
                              <p>'.$row['description'].'</p>
                            </div>
                           
                        </div>
                    </div>
                    '
                    ?>
                    <?php
                    mysql_close($con);
                    ?>
                </div>
                 <div class="col-md-6">
                    <h1 class="section-heading">Christmas Sale</h1>
                    <img class="img-responsive img-center roundcorners" src="img/xmas1.jpg" height="500" alt="">
                </div>
            </div>
        </div>
  <!--  </section>
    
     <section>-->
        <div class="container">
        </br>
            <h1 style="text-align:center;">Like, Mean Deals</h1>
        </br>
            <?php
                $con = mysql_connect("sulley.cah.ucf.edu","ka578143","DancinG#93");
                if (!$con) {
                    die("Can not Connect: " . mysql_error());
                }
                mysql_select_db("ka578143",$con);

                $sql = 'SELECT * FROM wednesday where productID=46 || productID=215 || productID=405';
                $myData = mysql_query($sql,$con);
                ?>

                <?php
                    while ($row = mysql_fetch_array($myData))  
                    echo'
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="product_details.php?id='.$row['productID'].'"><img src="'.$row['productThumb'].'" alt="'.$row['productThumb'].'"></a>
                            <div class="caption">
                                <h2 class="pull-right" style="color:#d824c9;">'.$row['price'].'</h2>
                                <h2><a href="product_details.php?id='.$row['productID'].'">'.$row['productName'].'</a>
                                </h2>
                              <p>'.$row['description'].'</p>
                            </div>
                          
                        </div>
                    </div>
                    '
                    ?>

    </section>

   

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>This site is not official and is an assignment for a UCF Digital Media course</p>
                    <p>designed by Wednesday</p>
                   
                </div>
                <div class="col-lg-3">
                	<p><strong>Contact</strong></p>
                    <p>1-800-2468</p>
                    <p>4000 Central Florida Blvd</p>
                    <p>Orlando, FL 32816</p>
                </div>
                  <div class="col-lg-3">
                	<i class="fa fa-facebook fa-2x"></i>
                    <i class="fa fa-twitter fa-2x"></i>
                    <i class="fa fa-google-plus fa-2x"></i>
                    <i class="fa fa-pinterest-p fa-2x"></i>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </footer>
		<?php
				mysql_close($con);
			?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>