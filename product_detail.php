<?php
ob_start();
session_start();
include("connection.php");
 
 $id=$_REQUEST['id'];
 $select_data="select * from product where id=$id";
 $query=mysqli_query($connection,$select_data);
 $data=mysqli_fetch_array($query);
 $product_price=$data['price'];

if(isset($_REQUEST['btncart']))
{
    $qty=$_REQUEST['qty'];

    header("location:cart.php?id=$id&&qty=$qty&&product_price=$product_price");
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Product-Details</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <?php 
    include("topheader.php");
    ?>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
         <form method="post">
               
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="adminpanel/<?php echo $data['image'];?>" alt="First slide"> </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?php echo $data['name']?></h2>
                        <h5>$<?php echo $data['price']?></h5>
                        <p class="available-stock"><span> <?php echo $data['qty']?> Quantities Are Available</span><p>
						<h4>Short Description:</h4>
						<p><?php echo $data['description']?></p>
						<ul>
							<li>
								<div class="form-group quantity-box">
									<label class="control-label">Quantity(Kg)</label>
									<input class="form-control" name="qty" value="1" min="1" max="20" type="number">
								</div>
							</li>
						</ul>

						<div class="price-box-bar">
							<div class="cart-and-bay-btn">
							
                            <!--     <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                             -->	
                            <?php 
                             if($_SESSION['user_id']=='')
                             {
                             ?>
                             <a class="btn hvr-hover" data-fancybox-close="" href="customer_login.php?id=<?php echo $_REQUEST['id']; ?>">Add to cart</a>
                             <?php 
                                }
                                else
                                {
                                    ?>
                                    <input type="submit" class="btn hvr-hover" data-fancybox-close="" name="btncart" value="Add To Cart" style="color: white;">
                                     

                                    <?php
                                }
                             ?>

                           

                            </div>
						</div>

						<div class="add-to-btn">
							<div class="add-comp">
							</div>
							<div class="share-bar">
								</div>
						</div>
                    </div>
                </div>
            </div>
			
	</form>
    
        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
    <?php
    include("footer.php")
    ?>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>