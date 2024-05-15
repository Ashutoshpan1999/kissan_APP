<?php 
error_reporting(0);
ob_start();
session_start();
$connection=mysqli_connect("localhost","root","","project");
$id=$_SESSION['user_id'];
$my_order="select * from orders as o, product as p  where o.o_product_id=p.id and  o.o_user_id='$id'";
$cart1=mysqli_query($connection,$my_order) or die(mysqli_error($connection));

// if(isset($_REQUEST['id']))
// {
//     $pid=$_REQUEST['id'];
//     $uid=$_SESSION['user_id'];
//     $qty=$_REQUEST['qty'];
//     $unit_price=$_REQUEST['product_price'];
//     $total_price=$qty*$unit_price;


//     $insert_cart="insert into cart(c_product_id,c_user_id,c_qty,c_unit_price,c_total_price)values('$pid','$uid','$qty','$unit_price','$total_price')";
//     $insert_cart1=mysqli_query($connection,$insert_cart);
//                 header("location:cart.php");    
                
   
    
// }
// if(isset($_REQUEST['d']))
// {
//     $id=$_REQUEST['d'];
//     $d="delete from cart where c_id='$id'";
//     mysqli_query($connection,$d);
//     header("location:cart.php");

// }
//$cart="select * from orders as o, product as p where p.id=o.o_product_id and o.o_user_id='$uid'";
//$cart1=mysqli_query($connection,$cart);

//$my_data="select * from user where u_id='$uid'";
//$my_data1=mysqli_query($connection,$my_data);
//$my_data2=mysqli_fetch_array($my_data1);

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
    <title>Cart Page</title>
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
</head>

<body>
    <!-- Start Main Top -->
    <?php 
include("topheader.php");
?>
   <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Orders</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                          <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                          <a class="btn hvr-hover" data-fancybox-close="" href="index.php">Continue Shopping</a>
                          
                        </div>
                    </div>
                </div>
              <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <!-- <th>Remove</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$ord=rand(100000,999999); 
                                while($cart2=mysqli_fetch_array($cart1))
                                {
                                ?>
                                <tr>
                                    <td class="name-pr">
                                        <a href="#">
                                    <?php echo $cart2['order_no']; ?>
                                </a>
                                    </td>
                                   
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="adminpanel/<?php echo $cart2['image']; ?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									<?php echo $cart2['name']; ?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>Rs. <?php echo $cart2['o_unit_price']; ?></p>
                                    </td>
                                    <td class="quantity-box">
                                    <?php echo $cart2['o_qty']; ?></td>
                                    <td class="total-pr">
                                        <p>Rs. <?php echo $cart2['o_total_price']; ?></p>
                                    </td>
                                   <!--  <td class="remove-pr">
                                        <a href="cart.php?d=<?php echo $cart2['c_id']; ?>">
									<i class="fas fa-times" onclick="return confirm('Are You Sure to Delete from This cart?')"></i>
								</a>
                                    </td> -->
                                </tr>
                              <?php 

                                }    
                              
                              ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
              
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                          <a class="btn hvr-hover" data-fancybox-close="" href="index.php">Continue Shopping</a>
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                 </div>
           

            </div>

           

                
</form>


                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
   <!--  <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
    <?php include("connection.php"); ?>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. 2021 </p>
    </div>
    <!-- End copyright  -->


    <!-- ALL JS FILES -->
    
</body>

</html>