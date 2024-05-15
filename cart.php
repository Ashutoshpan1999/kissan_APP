<?php 
error_reporting(0);
ob_start();
session_start();
$connection=mysqli_connect("localhost","root","","project");
$uid=$_SESSION['user_id'];
  
if(isset($_REQUEST['id']))
{
    $pid=$_REQUEST['id'];
    $uid=$_SESSION['user_id'];
    $qty=$_REQUEST['qty'];
    $unit_price=$_REQUEST['product_price'];
    $total_price=$qty*$unit_price;


    $insert_cart="insert into cart(c_product_id,c_user_id,c_qty,c_unit_price,c_total_price)values('$pid','$uid','$qty','$unit_price','$total_price')";
    $insert_cart1=mysqli_query($connection,$insert_cart);
    header("location:cart.php");    
                
   
    
}
if(isset($_REQUEST['d']))
{
    $id=$_REQUEST['d'];
    $d="delete from cart where c_id='$id'";
    mysqli_query($connection,$d);
    header("location:cart.php");

}
$cart="select * from cart as c, product as p where p.id=c.c_product_id and c.c_user_id='$uid'";
$cart1=mysqli_query($connection,$cart);

$my_data="select * from user where u_id='$uid'";
$my_data1=mysqli_query($connection,$my_data);
$my_data2=mysqli_fetch_array($my_data1);

$my_data11=mysqli_num_rows($my_data1);


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

    <!-- Start Main Top -->
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ord=rand(100000,999999); 
                                if($my_data11!=0)
                                {
                                while($cart2=mysqli_fetch_array($cart1))
                                {
                                    if(isset($_REQUEST['btncheckout']))
                                    {
                                    $cid=$cart2['c_id'];
                                    $pid=$cart2['c_product_id'];
                                    $uid=$_SESSION['user_id'];
                                    $unit_price=$cart2['c_unit_price'];
                                    echo $qty=$cart2['c_qty'];
                                    echo $payment_mode=$_REQUEST['paymentMethod'];
                                    $total_price=$cart2['c_total_price'];
                                    $my_order="insert into orders (o_product_id,o_user_id,order_no,o_unit_price,o_qty,o_total_price,o_payment_mode) values ('$pid','$uid','$ord','$unit_price','$qty','$total_price','$payment_mode')";
                                    mysqli_query($connection,$my_order) or die(mysqli_error($connection));
                                    $deletecart="delete from cart where c_id='$cid'";
                                    mysqli_query($connection,$deletecart);
                                        $avb_qty="select * from product where id='$pid'";
                                        $avb_qty1=mysqli_query($connection,$avb_qty);
                                        $avb_qty2=mysqli_fetch_array($avb_qty1);
                                        
                                        $available_qty=$avb_qty2['qty'];
                                        $current_qty=$available_qty-$qty;
                                        $up="update product set qty='$current_qty' where id='$pid'";
                                        mysqli_query($connection,$up);

                                        $get_customer="select * from user where u_id='$uid'";
                                        $query_customer=mysqli_query($connection,$get_customer);
                                        $fetch_customer=mysqli_fetch_array($query_customer);
                                        if($payment_mode=='online')
                                        {
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                                            curl_setopt($ch, CURLOPT_HEADER, FALSE);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER,
                                                       array("X-Api-Key:test_914cda966e57b3be6344ed12c9d",
                                                              "X-Auth-Token:test_fee0f71ffe8482aeb527ca48714"));
                                            $payload = Array(
                                                'purpose' => $avb_qty2['name'],
                                                'amount' => $avb_qty2['price'],
                                                'phone' => $fetch_customer['u_contact'],
                                                'buyer_name' => $fetch_customer['u_name'],
                                                'redirect_url' =>"http://localhost/my_project/notification.php?orderno=".$ord."&",
                                                'send_email' => true,
                                                'send_sms' => true,
                                                'email' =>$fetch_customer['u_email'],
                                                'allow_repeated_payments' => false
                                            );
                                            curl_setopt($ch, CURLOPT_POST, true);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                                            $response = curl_exec($ch);
                                            curl_close($ch); 
                                            $response=json_decode($response);
                                            echo '<pre>';
                                            print_r($response->payment_request->longurl);
                                            echo "hello";
                                            
                                            // $_SESSION['TID']=$response->payment_request->id;
                                            // $_SESSION['phone']=$phone;
                                            header('location:'.$response->payment_request->longurl);
                                            die();
                                        }
                                        else
                                        {

                                    header("location:notification.php?orderno=$ord");
                                        }

                                    }




                                ?>
                                <tr>
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
                                        <p>Rs. <?php echo $cart2['c_unit_price']; ?></p>
                                    </td>
                                    <td class="quantity-box">
                                        <input type="text" value="<?php echo $cart2['c_qty']; ?>" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p>Rs. <?php echo $cart2['c_total_price']; ?></p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="cart.php?d=<?php echo $cart2['c_id']; ?>">
									<i class="fas fa-times" onclick="return confirm('Are You Sure to Delete from This cart?')"></i>
								</a>
                                    </td>
                                </tr>
                               <?php 
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td>Empty Cart  </td>
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
                        <a class="btn hvr-hover"  href="index.php">
                        <div class="input-group input-group-sm">
                          Continue Shopping
                          
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                 </div>
           

            </div>
            <?php 
            if($my_data11!=0)
            {
            ?>
            <div class="row my-5">
                <div class="col-lg-6 col-sm-12">
                            <form class="needs-validation" method="post" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $my_data2['u_name']; ?>" disabled required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" placeholder="" value="<?php echo $my_data2['u_email']; ?>" disabled>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Shipping Address *</label>
                                <input type="text" class="form-control" id="address" placeholder="" value="<?php echo $my_data2['u_address']; ?>" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="mb-3">
                                <label for="Pincode" >Pincode *</label>
                                <input type="text" class="form-control" id="address" minlength="6" placeholder="" value="<?php echo $my_data2['u_shiping_pincode']; ?>" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                           
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <table>
                                    <tr>
                                        <th>
                                            <input name="paymentMethod" type="radio" checked value="cod">COD
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <input name="paymentMethod" type="radio" value="online">ONLINE 
                                        </th>
                                    </tr>
                                    </table>
                                    
                                </div>
                             </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> 
                                Rs. 
                                <?php 
                                    $sum="select sum(c_total_price) from cart where c_user_id='$uid'"; 
                                    $sum1=mysqli_query($connection,$sum);
                                    $sum2=mysqli_fetch_array($sum1);
                                    echo $sum2[0];
                                ?>
                             </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5">Rs. <?php echo $sum2[0]; ?> </div>
                        </div>
                        <hr> </div>
                </div>
                
                <div class="col-12 d-flex shopping-box">
                    <input type="submit" class="ml-auto btn hvr-hover" name="btncheckout" value="Checkout" style="color: white;"></a> 
</form>


                </div>
            </div>
            <?php 
        }
            ?>
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
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a></p>
    </div>
    <!-- End copyright  -->


    <!-- ALL JS FILES -->
    
</body>

</html>