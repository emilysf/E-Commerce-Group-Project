<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productBycode = $db_handle->runQuery("SELECT * FROM wednesday WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productBycode[0]["code"]=>array('productName'=>$productBycode[0]["productName"], 'code'=>$productBycode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productBycode[0]["price"],'productThumb'=>$productBycode[0]["productThumb"], 'productImage'=>$productBycode[0]["productImage"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productBycode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productBycode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Wednesday Cart</title>

<style>
@import url('css/bootstrap.css');
@import url('css/bootstrap.min.css');
@import url('css/full-width-pics.css');
@import url('css/shop-homepage.css');
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
            <div class="col-lg-4"><a href="home.php"><img src="img/wednesday_logo1.png" alt="Wednesday"></a></div>
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
                         <a href="cart.php"><img src="img/shoppingbag.png"></a>
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
           
          
            	</div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<body>





<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="table table-hover">
            	
                          <div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th class="th3"><strong>Name</strong></th>
<th class="th3"><strong>Code</strong></th>
<th class="th1"><strong>Quantity</strong></th>
<th class="th2"><strong>Price</strong></th>
<th class="th2"><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
               
				<td><strong><?php echo $item["productName"]; ?></strong>
                <br/>
                <div class="cartmobile"><img src="<?php echo $item["productThumb"];?>"></div></td>
				<td><?php echo $item["code"]; ?></td>
				<td><div style="text-align:center;"><?php echo $item["quantity"]; ?></div></td>
				<td align=right><?php echo "$".$item["price"]; ?></td>
				<td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" id="btnEmpty">Remove Item</a></td>
              
				</tr>
                
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>
               
                      
                      
                      
                      
                      
                      
                      
                       
                 
                
                 
          <div class="row">
                    	<div class="col-sm-12 col-md-12 pull-right">
                      
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
            		<input type="hidden" name="cmd" value="_s-xclick">
            		<input type="hidden" name="hosted_button_id" value="VBPJY5U4H3CKL">
            		<input type="submit" class="btn btn-success pull-right" value="Checkout" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        	</form>
                

                
             
                  
                    </div>
                    </div>
            
            </div>
        </div>
    </div>
</div>









<div class="container" id="pay" style="visibility:hidden;">

   
	<div class="row">
        <div class="col-md-12 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Shipping Information
                    </h3>
                  <!--  <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" />
                            Use For Billing
                        </label>
                    </div>-->
                </div>
               
                <div class="panel-body1">
                
                    <form role="form">
                
                    <div class="row">
                        <div class="col-xs-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="firstName">
                                    First Name</label>
                                <input type="text" class="form-control" id="firstName"  required />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 pull-left">
                            <div class="form-group">
                                <label for="lastName">
                                    Last Name</label>
                                <input type="text" class="form-control" id="lastName"  required />
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-12  ">
                            <div class="form-group">
                                <label for="firstName">
                                    Address Line 1</label>
                                <input type="text" class="form-control" id="firstName"  required />
                            </div>
                        </div>
                          <div class="col-xs-12  ">
                            <div class="form-group">
                                <label for="firstName">
                                    Address Line 2</label>
                                <input type="text" class="form-control" id="firstName"  required />
                            </div>
                        </div>
                    
                    
                  
                     <div class="row">
                        <div class="col-xs-4 col-md-4 pull-left">
                            <div class="form-group">
                                <label for="city">
                                    City</label>
                                <input type="text" class="form-control"  id="city" required />
                            </div>
                        </div>
                        <div class="col-xs-4 col-md-4 pull-left">
                            <div class="form-group">
                                <label for="state">
                                    State</label>
                                <input type="text" class="form-control" id="state" required />
                            </div>
                        </div>
                        <div class="col-xs-4 col-md-4 ">
                            <div class="form-group">
                                <label for="zipCode">
                                    Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" required />
                            </div>
                        </div>
                    </div>
                    
                    </form>
                </div>
            </div>
           
        </div>
        <div class="col-md-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                <!--    <div class="checkbox pull-right">
                        <label>
                            <input type="checkbox" />
                            Remember
                        </label>
                    </div>-->
                </div>
                <div class="panel-body1">
                    <form role="form">
                    <div class="col-xs-12  ">
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">
                                    CV CODE</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CV" required />
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    
                    </form>
                </div>
            </div>
          
            <br/>
            <a href="confirm.php" class="btn btn-success btn-lg btn-block" role="button" style="color:white;">Pay</a>
        </div>
    </div>

   
</div>


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
    
    <script>
	function showPay() {
		document.getElementById("pay").style.visibility = "visible";
	}
	
	</script>
		
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
