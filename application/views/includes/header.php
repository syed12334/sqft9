<?php
    $category = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc');

?>
<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/sqft9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 08:20:41 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Real Estate Online Solution">
    <meta name="author" content="">
    <title>Real Estate Online Solution</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="<?= asset_url();?>css/jquery-ui.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="<?= asset_url();?>font/flaticon.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/fontawesome-5-all.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/font-awesome.min.css">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="<?= asset_url();?>css/search.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/animate.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/aos.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/aos2.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/lightcase.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/menu.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/slick.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/styles.css">
    <link rel="stylesheet" id="color" href="<?= asset_url();?>css/default.css">
    <link rel="stylesheet" id="color" href="<?= asset_url();?>revolution/css/navigation.css">
    <link rel="stylesheet" id="color" href="<?= asset_url();?>revolution/css/settings.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/maps.css">
    <link rel="stylesheet" id="color" href="<?= asset_url();?>css/colors/pink.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta property="og:title" content="Real Estate Online  Solution">
<meta property="og:image" content="https://www.sqft9.com/assets/images/logo.png">
<meta property="og:url" content="https://www.sqft9.com">
<meta property="og:description" content="Real Estate Online Solution">
<meta property="og:site_name" content="www.sqft9.com">
   <!--    <link rel="stylesheet" href="css/leaflet.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/leaflet-gesture-handling.min.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/leaflet.markercluster.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/leaflet.markercluster.default.css">
    <! ARCHIVES CSS -->
   <!--  <link rel="stylesheet" href="<?= asset_url();?>css/timedropper.css">
    <link rel="stylesheet" href="<?= asset_url();?>css/datedropper.css">  -->
    <style type="text/css">
        .favourite {
            color:red!important;
        }
         #auto {
        width:100%;
        z-index:9999;
        display: none
    }
    .autocomplete {
        list-style: none;
    padding: 0px;
    width: 94%;
    text-align: left;
    z-index: 9999999999999999!important;
    background: #fff;
    }
    .autocomplete li {
            border: 1px solid #ccc;
    padding: 10px;
    }
    #autocompletebtnn {
        cursor: pointer!important
    }
       .hp-6 .rld-single-input input, .rld-single-select .select{
width:100%!important;
}
.share-a {
    width: 25px;
    position: absolute;
}

.share-a a {
    padding: 15px;
    display: inline-block;
    margin: 0px 0 0 -7px;
    padding: 5px;
}
    </style>

    
</head>

<body class="inner-pages listing homepage-9 hp-6 homepage-1 agents hd-white">
     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        <header id="header-container" class="header">
            <!-- Header -->
            <div id="header" class="head-tr bottom">
                <div class="container container-header">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <!-- Logo -->
                        <div id="logo">
                                <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                         <a href="<?= base_url();?>"><img src="<?= asset_url();?>images/logo.png" data-sticky-logo="<?= asset_url();?>images/logo.png" alt=""></a> 
                            <?php
                        }else {
                            ?>
   <a href="<?= base_url();?>"><img src="<?= asset_url();?>images/logo.png" data-sticky-logo="<?= asset_url();?>images/logo.png" alt=""></a>                            <?php
                        }

                        ?>
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
                        <nav id="navigation" class="style-1 head-tr">
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

                                    <li>                                                      <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?><a href="<?= base_url().'login';?>">Post Property</a><?php }else {

                                	?>
<li><a href="<?= base_url().'property/addproperty';?>">Post Property</a></li>

                                	<?php
                                } ?>
                                        <ul>
                                         
                                                                                  <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                            <li><a href="<?= base_url().'register';?>">Register</a></li>    
<?php
}else {
  
}
?>
       
                                          </ul>
                                    </li>
                                        <li><a href="<?= base_url().'register';?>">Builders</a></li>
                                  
<!--                                     <li><a href="#">Top Builders</a></li>
 -->                                    <li class="d-none d-xl-none d-block d-lg-block"><a href="#">Login</a></li>
                                    <li class="d-none d-xl-none d-block d-lg-block"><a href="#">Register</a></li>
                                    <li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="#" class="button border btn-lg btn-block text-center">Add Listing<i class="fas fa-laptop-house ml-2"></i></a></li>
                            </ul>
                        </nav>
                        <!-- Main Navigation / End -->
                    </div>
                    <!-- Left Side Content / End -->

                    <!-- Right Side Content / End -->
                    <div class="right-side d-none d-none d-lg-none d-xl-flex">
                        <!-- Header Widget -->
                       <!--  <div class="header-widget">
                            <a href="#" class="button border">Add Listing<i class="fas fa-laptop-house ml-2"></i></a>
                        </div> -->
                        <!-- Header Widget / End -->
                    </div>
                    <!-- Right Side Content / End -->

                    <!-- Right Side Content / End -->
                    <div class="header-user-menu user-menu add">
                        <div class="header-user-name">
                             <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                            <span><img src="<?= asset_url();?>images/testimonials/ts-1.jpg" alt=""></span>

                            <?php
                        }else {
                            $ar = $this->session->userdata(ADMIN_SESSION);

                              ?>
                            <span><img src="<?= asset_url();?>images/testimonials/ts-1.jpg" alt=""></span><?php echo ucfirst($ar['name']); ?>

                            <?php
                        }

                        ?>
                        </div>
                        <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                  <ul>
                            <li><a href="<?= base_url().'register';?>">Register</a></li>
                            <li><a href="<?= base_url().'login';?>">Login</a></li>
                          
                        </ul>
                                <?php
                            }else {
                                ?>
                                  <ul>
                            <li><a href="<?= base_url().'property/editprofile';?>"> Edit profile</a></li>
                            <li><a href="<?= base_url().'property/changepass';?>"> Change Password</a></li>
                            <li><a href="<?= base_url().'settings';?>"> Settings</a></li>

                            <li><a href="<?= base_url().'login/logout';?>">Log Out</a></li>
                        </ul>
                                <?php
                            }
                        ?>
                      
                    </div>
                    <!-- Right Side Content / End -->

                    <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                
                        <!-- Header Widget / End -->
                    </div>
                    <!-- Right Side Content / End -->

                </div>
            </div>
            <!-- Header / End -->

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->