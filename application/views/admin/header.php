<?php 
        //echo "<pre>";print_r($category);exit;
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Sqft9</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="<?= asset_url();?>css/jquery-ui.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="<?= asset_url();?>css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/font-awesome.min.css">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="<?= asset_url();?>css/search.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/dashbord-mobile-menu.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/animate.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/swiper.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/lightcase.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/owl-carousel.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/menu.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/slick.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/styles.css">
    <link rel="stylesheet" id="color" href="css/default.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/maps.css">
    <link rel="stylesheet" id="color" href="<?= asset_url();?>css/colors/pink.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link href="<?= asset_url();?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
          #header.cloned.sticky{
            display: none!important;
        }
        .topi {
    float: right;
    font-size: 30px;
    margin: 8px 55px 5px 6px;
    position: relative;
    color: #0e183c;
}

.ms{
   margin: 8px 28px 5px 6px;
}

.topi .badge{
    position: absolute;
    top: -3px;
    right: -12px;
    font-size: 11px;

}
        </style>

</head>

<body class="inner-pages maxw1600 m0a dashboard-bd">
    <!-- Wrapper -->
    <div id="wrapper" class="int_main_wraapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        <div class="dash-content-wrap">
            <header id="header-container" class="db-top-header">
                <!-- Header -->
                <div id="header">
                    <div class="container-fluid">
                        <!-- Left Side Content -->
                        <div class="left-side">
                            <!-- Logo -->
                            <div id="logo">
                                <a href="<?= base_url();?>"><img src="<?= asset_url();?>images/logo.png" alt=""></a>
                            </div>
                            <!-- Mobile Navigation -->
                            <div class="mmenu-trigger">
                                <button class="hamburger hamburger--collapse" type="button">
                                    <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                            <!-- Main Navigation -->
                            <nav id="navigation" class="style-1">
                                <ul id="responsive">
                                    <li><a href="#">Rent</a>
                                        <ul>

                                            <?php
                                                if(count($category)>0) {
                                                    foreach ($category as $key => $value) {
                                                        ?>
                                                        <li><a href="<?= base_url().'home/categorylist?id='.sqftEncrypt($value->id).'&pid='.sqftEncrypt(1).'';?>"><?= $value->name; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                            ?> 
                                        </ul>
                                    </li>
                                        <li><a href="#">Buy</a> 
                                            <ul>
                                            <?php
                                                if(count($category)>0) {
                                                    foreach ($category as $key => $value) {
                                                        ?>
                                                        <li><a href="<?= base_url().'home/categorylist?id='.sqftEncrypt($value->id).'&pid='.sqftEncrypt(2).'';?>"><?= $value->name; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                            ?> 
                                         
                                              </ul>
                                        </li>
                                       <li><a href="#">Sell</a>
                                        <ul>
                                         
                                                                                  <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                <li><a href="<?= base_url().'property/addproperty';?>">Post Property</a></li>
                            <li><a href="<?= base_url().'register';?>">Register</a></li>    
<?php
}else {
  ?>
     <li><a href="<?= base_url().'property/addproperty';?>">Post Property</a></li>
  <?php  
}
?>
       
                                          </ul>
                                    </li>
                                        
                                      
<!--                                         <li><a href="#">Top Builders</a></li>
 -->                                        <li class="d-none d-xl-none d-block d-lg-block"><a href="#">Login</a></li>
                                        <li class="d-none d-xl-none d-block d-lg-block"><a href="#">Register</a></li>
                                        <li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="#" class="button border btn-lg btn-block text-center">Add Listing<i class="fas fa-laptop-house ml-2"></i></a></li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                            <!-- Main Navigation / End -->
                        </div>
                        <!-- Left Side Content / End -->
                        <!-- Right Side Content / -->
                         
                        
                        <div class="header-user-menu user-menu">

                       
                         

                            <div class="header-user-name">
                        <span><img src="<?= asset_url();?>images/testimonials/ts-1.jpg" alt=""></span> 
                        <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {

                            }else {

                                    $ar = $this->session->userdata(ADMIN_SESSION);
                                    echo $ar['name'];
                                  }
                            ?>
                          
                            </div>
                            <ul>
                                <li><a href="<?= base_url().'property/editprofile';?>"> Edit profile</a></li>
                                <li><a href="<?= base_url().'property/addproperty';?>"> Add Property</a></li>
                                <li><a href="<?= base_url().'property/changepass';?>"> Change Password</a></li>
                                <li><a href="<?= base_url().'login/logout';?>">Log Out</a></li>
                            </ul>
                        </div>

                 <!--        <div class="topi"> <i class="fa fa-address-book"></i> <label class="badge badge-success">0</label></div>

                        <div class="topi ms"> <i class="fa fa-address-book"></i> <label class="badge badge-success">0</label></div> -->
                        <!-- Right Side Content / End -->
                    </div>
                </div>
                <!-- Header / End -->
            </header>
        </div>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
         <section class="user-page section-padding pt-5">
            <div class="container-fluid">
                <div class="row">
                            <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                        <div class="user-profile-box mb-0">
                            <div class="sidebar-header"><div class="sidebar-header"><a href="<?= base_url().'dashboard';?>"><img src="<?= asset_url();?>images/footer_logo.png" alt="header-logo2.png"></a> </div> </div>
                            <div class="header clearfix">
                                <img src="<?= asset_url();?>images/testimonials/ts-1.jpg" alt="avatar" class="img-fluid profile-img">
                            </div>
                            <div class="active-user">
                                <h2>Mary Smith</h2>
                            </div>
                            <div class="detail clearfix">
                                <ul class="mb-0">
                                    
                                    <li>
                                        <a href="<?= base_url().'property/editprofile';?>">
                                            <i class="fa fa-user"></i>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'property/subscriptionList';?>">
                                            <i class="fa fa-user"></i>My Subscriptions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'property/myproperty';?>">
                                            <i class="fa fa-list" aria-hidden="true"></i>My Properties
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'property/wishlist';?>">
                                            <i class="fa fa-heart" aria-hidden="true"></i>Favourite Properties
                                        </a>
                                    </li>

                                     <li>
                                        <a href="<?= base_url().'property/owneraddress';?>">
                                            <i class="fa fa-heart" aria-hidden="true"></i>Contact List
                                        </a>
                                    </li>
                                
                                   
                                    <li>
                                        <a href="<?= base_url().'property/invoice';?>">
                                            <i class="fas fa-paste"></i>Invoices
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'property/changepass';?>">
                                            <i class="fa fa-lock"></i>Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'login/logout';?>">
                                            <i class="fas fa-sign-out-alt"></i>Log Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">
                         <div class="col-lg-12 mobile-dashbord dashbord">
                            <div class="dashboard_navigationbar dashxl">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Dashboard Navigation</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user mr-3"></i>Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user mr-3"></i>My Subscription
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url().'admin/myproperty';?>">
                                                <i class="fa fa-list mr-3" aria-hidden="true"></i>My Properties
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-heart mr-3" aria-hidden="true"></i>Favorited Properties
                                            </a>
                                        </li>
                                        <li>
                                            <a class="active" href="#">
                                                <i class="fa fa-list mr-3" aria-hidden="true"></i>Add Property
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-paste mr-3"></i>Invoices
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-lock mr-3"></i>Change Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url().'login/logout';?>">
                                                <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>

