    <?php
error_reporting(0);
$req = $_POST['search'];
$con = mysql_connect("sulley.cah.ucf.edu","ka578143","DancinG#93");
if (!$con) {
	die("Can not Connect: " . mysql_error());
}
$req = mysql_escape_string($req);

//echo($req);

mysql_select_db("ka578143",$con);
if($req == "") {
$sql = 'SELECT * FROM wednesday';
} else {
	$sql = 'SELECT * FROM wednesday WHERE gender="women" AND ( category LIKE "%'.$req.'%" OR productName LIKE "%'.$req.'%")';
}
echo("<!-- ".$sql."-->");
$searchData = mysql_query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wednesday Womens Catalog</title>
    
    
    <style>
@import url('css/bootstrap.css');
@import url('css/bootstrap.min.css');
@import url('css/full-width-pics.css');
@import url('css/shop-homepage.css');
@import url('css/styles.css');
@import url(https://fonts.googleapis.com/css?family=Montserrat);
</style>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Bootstrap Core CSS -->
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <!--<link href="css/shop-homepage.css" rel="stylesheet">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    <!-- Page Content -->
    
    <?php

//$con = mysql_connect("sulley.cah.ucf.edu","ka578143","DancinG#93");
if (!$con) {
	die("Can not Connect: " . mysql_error());
}


mysql_select_db("ka578143",$con);
if (isset($_POST['womenShirts'])){ $_POST['womenShirts'] = mysql_escape_string($_POST['womenShirts']); }
if (isset($_POST['womenShirts'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="shirt"';
} else if (isset($_POST['womenBottoms'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="bottoms"';
} else if (isset($_POST['womenDresses'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="dress"';
} else if (isset($_POST['womenJackets'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="jacket"';
} else if (isset($_POST['womenShoes'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="shoes"';
} else if (isset($_POST['womenAccessories'])){
    $sql = 'SELECT * FROM wednesday WHERE gender="women" AND category="accessories"';
} else {
    $sql = 'SELECT * FROM wednesday WHERE gender="women"';
}

$myData = mysql_query($sql); 
//set a blank array
$searchthing = "";

if ($req == "") {$searchthing = $myData; } else { $searchthing = $searchData; };
?>
    <div class="container">

        <div class="row">

            <div class="col-md-3">

                <form method="post">
                    <div class="list-group">
                        <div class="list-group-item" style="text-align:center"><b>Women</b></div>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenShirts">Shirts</button>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenBottoms">Bottoms</button>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenDresses">Dresses</button>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenJackets">Jackets</button>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenShoes">Shoes</button>
                            <button class="list-group-item" style="text-align:center" type="submit" name="womenAccessories">Accessories</button>
                        </div>
                </form>

            </div>

            <div class="col-md-9">

              

                <div class="row">

    


					 <?php
					 
					 
                  while($row = mysql_fetch_array($searchthing))  
                    echo'
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="product_details.php?id='.$row['productID'].'">
								<img src="'.$row['productThumb'].'" alt="'.$row['productName'].'">
							</a>
                            <div class="caption">
                                <h5><a href="product_details.php?id='.$row['productID'].'">'.$row['productName'].'</a>
                                </h5>
                                <p>'.$row['description'].'</p>
                                <p class="pull-left">Stock: '.$row['stock'].'</p>
                                <p class="pull-right">'.$row['price'].'</p>
                            </div>
                        
                        </div>
                    </div>
                    '
                    ?>
					


               

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    

    

        <!-- Footer -->
       <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>This site is not official and is an assignment for a UCF Digital Media course</p>
                    <p>designed by Wednesday</p>
                   
                 <!--   <button type="button" class="btn btn-success pull-left">
                            <a href="admin.php" style="color:white;">Admin </a><span class="glyphicon glyphicon-user"></span>
                        </button>-->
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
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
  

</body>

</html>
