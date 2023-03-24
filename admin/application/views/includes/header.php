<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= asset_url();?>basic/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= app_asset_url();?>css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Corinthia:wght@700&family=Courgette&family=Lato:wght@400;700;900&family=Smooch&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <title>Admin - Sqft9 </title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset_url();?>css/app.css">


    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .btns {
            border:2px solid #000!important;
           
            cursor: pointer!important;
        }
        .btns1 {
             margin-left:7px!important;
             border:2px solid #000!important;
             cursor: pointer!important;
             padding:3.2px 5px;
        }
        .btns1 i {
            color:#000!important;
        }
        .headerview {
            background-color: #000;
            color:#fff;
            padding: 20px;
            margin-bottom: 20px
        }  
        .headerview h3 {
            color:#fff;
        } 
        .headerview h5 {
            color:#fff;
        }

         .headerview1 {
            background-color: #b98324;
            color:#fff;
            padding: 20px;
            margin-bottom: 20px
        }  
        .headerview1 h3 {
            color:#fff;
        } 
        .headerview1 h5 {
            color:#fff;
        }

        .headerview2 {
            background-color: green;
            color:#fff;
            padding: 20px;
            margin-bottom: 20px
        }  
        .headerview2 h3 {
            color:#fff;
        } 
        .headerview2 h5 {
            color:#fff;
        }


        .headerview3 {
            background-color: orange;
            color:#fff;
            padding: 20px;
            margin-bottom: 20px
        }  
        .headerview3 h3 {
            color:#fff;
        } 
        .headerview3 h5 {
            color:#fff;
        }

        .headerview4 {
            background-color: purple;
            color:#fff;
            padding: 20px;
            margin-bottom: 20px
        }  
        .headerview4 h3 {
            color:#fff;
        } 
        .headerview4 h5 {
            color:#fff;
        }


        .popup-detail {
background-color: #f5f7fb;
position: fixed;
left: 0;
top: -100%;
height: 100%;
width: 100%;
z-index: 99999999;
transition: 0.5s;
display: none;
}

.popup-detail.intro {
top: 0;
display: block;
overflow: auto;
}

.close-d {
    float: right;
    font-size: 18px;
    margin: 40px 90px 0 0;
    cursor: pointer;
    border: 1px solid red;
    color: red;
    padding: 3px 17px;
}
#name-error {
    color:red!important;
}
#email-error {
    color:red!important;
}
#phone-error {
    color:red!important;
}
#password-error {
    color:red!important;
}

#message {
    position: fixed;
    top:20px;
    right:10px;
    z-index:9999999999999!important;
}
button {
    cursor: pointer!important
}
.viewBox {
    padding: 1.5rem !important;
    background: #fff;
    border: 1px solid #eaeff5;
    -webkit-box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
    box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
    margin-bottom: 30px
}


    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
<!--     <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script> -->
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<aside class="main-sidebar fixed offcanvas shadow bg-primary text-white no-b theme-dark">
    <section class="sidebar">
        <div class="w-80px mt-3 mb-3 ml-3">
            <a href="<?= base_url();?>"><img src="<?= app_asset_url();?>images/footer_logo.png" alt=""></a>
        </div>
        <ul class="sidebar-menu">
         

        
          


              <li class="header mt-3"><strong>REPORTS</strong></li>
               <li class="treeview ">
                <a href="<?= base_url().'users';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Registered Users</span>
                </a>
              
            </li>
            <li class="treeview ">
                <a href="<?= base_url().'revenue'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Revenue Reports</span>
                </a>
              
            </li>
               <li class="treeview ">
                <a href="<?= base_url().'zonewisereport'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Zone Wise Reports</span>
                </a>
              
            </li>
             <li class="treeview ">
                <a href="<?= base_url().'propertyreporty'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Properties Reports</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'customerreport'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Customers Reports </span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'expiryreports'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Expiry Reports </span>
                </a>
              
            </li>
            <li class="treeview ">
                <a href="<?= base_url().'customerreviewreport'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Customers Review Reports</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'visitors'?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Total Site Visitors</span>
                </a>
              
            </li>


               <li class="header"><strong>MASTERS</strong></li>
              <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Subscription Packages<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'subscription';?>"><i class="icon icon-circle-o"></i>Manage Packages</a>
                    </li>
                   
                   
                </ul>
            </li>
       
            <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Property Category<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'propertycategory';?>"><i class="icon icon-circle-o"></i>Manage Categories</a>
                    </li>
                   
                   
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Property Amenities<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'amenities';?>"><i class="icon icon-circle-o"></i>Manage Amenities</a>
                    </li>
                  
                   
                </ul>
            </li>

              <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Properties<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'propertylist';?>"><i class="icon icon-circle-o"></i>Manage Properties</a>
                    </li>
                  
                   
                </ul>
            </li>


             <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>States<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'states';?>"><i class="icon icon-circle-o"></i>Manage States</a>
                    </li>
                  
                   
                </ul>
            </li>

             <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>City<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'cities';?>"><i class="icon icon-circle-o"></i>Manage City</a>
                    </li>
                  
                   
                </ul>
            </li>

                <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Area<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'area';?>"><i class="icon icon-circle-o"></i>Manage Area</a>
                    </li>
                  
                   
                </ul>
            </li>

               <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Testimonials<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'testimonials';?>"><i class="icon icon-circle-o"></i>Manage Testimonials</a>
                    </li>
                  
                   
                </ul>
            </li>

               <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Partners<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'partners';?>"><i class="icon icon-circle-o"></i>Manage Partners</a>
                    </li>
                  
                   
                </ul>
            </li>

               <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Pincodes<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'pincodes';?>"><i class="icon icon-circle-o"></i>Manage Pincodes</a>
                    </li>
                  
                   
                </ul>
            </li>

              <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Sliders<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'sliders';?>"><i class="icon icon-circle-o"></i>Manage Slider</a>
                    </li>
                  
                   
                </ul>
            </li>

             <li class="treeview"><a href="#"><i class="icon icon-account_box light-green-text s-18"></i>FAQ<i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url().'faq';?>"><i class="icon icon-circle-o"></i>Manage FAQ</a>
                    </li>
                  
                   
                </ul>
            </li>

              <li class="header mt-3"><strong>HOMEPAGE</strong></li>
            <li class="treeview ">
                <a href="<?= base_url().'aboutus';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>About</span>
                </a>
              
            </li>
             <li class="treeview ">
                <a href="<?= base_url().'terms';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Terms & Conditions</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'privacy';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Privacy Policy</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'cancellationpolicy';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Cancellation Policy</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'refundpolicy';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Refund Policy</span>
                </a>
              
            </li>

         

             <li class="treeview ">
                <a href="<?= base_url().'contactus';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Contact Us</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'brochure';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Brochure Upload</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'sociallinks';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Social Links</span>
                </a>
              
            </li>

             <li class="treeview ">
                <a href="<?= base_url().'newsletter';?>">
                    <i class="icon icon-package text-lime s-18"></i> <span>Newsletter</span>
                </a>
              
            </li>

            
           
        </ul>
    </section>
</aside>

<!--Sidebar End-->
<div class="has-sidebar-left">
    <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
            <div class="search-bar">
                <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                       placeholder="start typing...">
            </div>
            <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
               aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
        </div>
    </div>
</div>
    <div class="sticky">
        <div class="navbar navbar-expand d-flex justify-content-between bd-navbar white shadow">
            <div class="relative">
                <div class="d-flex">
                    <div>
                        <a href="#"  data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                            <i></i>
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <h1 class="nav-title text-white">Dashboard</h1>
                    </div>
                </div>
            </div>
            <!--Top Menu Start -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
     
        <!-- User Account-->
        <li class="dropdown custom-dropdown user user-menu ">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <img src="<?= asset_url();?>img/dummy/user_icon.png" class="user-image" alt="User Image">
                <i class="icon-more_vert "></i>
            </a>
            <div class="dropdown-menu p-4 dropdown-menu-right">
                <div class="row box justify-content-between my-4">
                    <div class="col">
                        <a href="<?= base_url().'Login/logout';?>">
                            <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                            <div class="pt-1">Logout</div>
                        </a>
                    </div>
                   
                </div>
               
             
            </div>
        </li>
    </ul>
</div>
        </div>
    </div>
    </div>