        
<?php

 $contact = $this->master_db->getRecords('contactus',['status'=>0],'*','id desc');
 $category = $this->master_db->getRecords('property_category',['status'=>0],'id,name','name asc','','','4');
 $sociallinks = $this->master_db->getRecords('sociallinks',['status'=>0],'facebook,twitter,linkedin,instagram,youtube','id asc');
 //echo $this->db->last_query();exit;

 ?>
 <style type="text/css">
     .first-footer .contactus ul li {
        margin-bottom: 0px!important
     }
 </style>
        <!-- START FOOTER -->
        <footer class="first-footer rec-pro">
            <div class="top-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="netabout">
                                <a href="<?= base_url()?>" class="logo">
                                    <img src="<?php base_url()?>assets/images/footer_logo.png" alt="" style="width:30%">
                                </a>
                              
                            </div>
                            <div class="contactus">
                                <p style="color:#fff">For feedback please write to us :</p>
                                <ul>
                                    <li>
                                        <div class="info">
                                            <?php if(!empty($contact[0]->address)) {
                                                ?>
                                                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p class="in-p"><?php if(!empty($contact[0]->address)) {echo $contact[0]->address;} ?></p>
                                                <?php

                                            } ?>
                                           
                                        </div>
                                    </li>
                                    <li>
                                        <div class="info" style="padding-bottom: 10px">
                                            <?php if(!empty($contact[0]->phone)) {?>  <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p class="in-p"><?php if(!empty($contact[0]->phone)) {echo $contact[0]->phone;} ?></p> <?php } ?>
                                          
                                        </div>
                                    </li>
                                    <li>
                                        <div class="info">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <p class="in-p ti"><?php if(!empty($contact[0]->email)) {echo $contact[0]->email;} ?></p>
                                        </div>
                                    </li>


                                </ul>

                                 <ul style="margin-top: 30px;line-height: 28px">
                                    <li>
                                        <a href="<?= base_url().'about';?>" style="color:#fff;text-decoration: none">About Us</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'terms';?>" style="color:#fff;text-decoration: none">Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'privacy-policy';?>" style="color:#fff;text-decoration: none">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url().'refund-policy';?>" style="color:#fff;text-decoration: none">Refund Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="navigation">
                                <h3 style="float: left">Rent</h3>  <h3 style="float: left;margin-left:50px">Buy</h3>
                                <div class="clearfix"></div>
                                <div class="nav-footer">
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
                                    <ul class="nav-right">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="widget">
                                <h3>Twitter Feeds</h3>
                                <div class="twitter-widget contuct">
                                    <div class="twitter-area">
                                        <div class="single-item">
                                           
                                            <div class="text" style="width: 100%;overflow: scroll;height: 180px">
                                             <a class="twitter-timeline" href="https://twitter.com/Sqft9I?ref_src=twsrc%5Etfw">Tweets by Sqft9I</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="newsletters">
                                <h3>Newsletters</h3>
                                <p>Sign Up for Our Newsletter to get Latest Updates and Offers. Subscribe to receive news in your inbox.</p>
                            </div>
                            <div class="successerror"></div>
                            <form class="bloq-email  form-inline" method="post">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                <label for="subscribeEmail" class="error"></label>
                                <div class="email">
                                    <input type="email" id="subscribeEmail" name="subscribeEmail" placeholder="Enter Your Email">
                                    <input type="submit" value="Subscribe" id="ssubmit">
                                </div>
                            </form>
                            <h3 style="margin-top: 30px">Address</h3>
                            <p style="color:#fff;"><i class="fa fa-map-marker" style="margin-right:10px"></i>Office- No. 86, Virupakshapura (7th Cross), Kodigehalli, V.R. Pura, Yelahanka, Bengaluru, Karnataka, India- 560097</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="second-footer rec-pro">
                <div class="container-fluid sd-f">
                    <p>2022 © Copyright - All Rights Reserved.</p>
                    <ul class="netsocials" style="margin-right: 60px">
                        <?php 
                            if(!empty($sociallinks[0]->facebook)) {
                                ?>
                                 <li><a href="<?= $sociallinks[0]->facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php
                            }

                        ?>
                          <?php 
                            if(!empty($sociallinks[0]->twitter)) {
                                ?>
                                 <li><a href="<?= $sociallinks[0]->twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php
                            }

                        ?>
                          <?php 
                            if(!empty($sociallinks[0]->linkedin)) {
                                ?>
                                 <li><a href="<?= $sociallinks[0]->linkedin; ?>" target="_blank" style="color:#fff"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <?php
                            }

                        ?>
                          <?php 
                            if(!empty($sociallinks[0]->instagram)) {
                                ?>
                                 <li><a href="<?= $sociallinks[0]->instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php
                            }

                        ?>

                           <?php 
                            if(!empty($sociallinks[0]->youtube)) {
                                ?>
                                 <li><a href="<?= $sociallinks[0]->youtube; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <?php
                            }

                        ?>
                       
                        
                    </ul>
                </div>
            </div>
        </footer>

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->

        <!--register form -->
        <div class="login-and-register-form modal">
            <div class="main-overlay"></div>
            <div class="main-register-holder">
                <div class="main-register fl-wrap">
                    <div class="close-reg"><i class="fa fa-times"></i></div>
                    <h3>Welcome to <span>Sqft9</span></h3>
                    
                    <div id="tabs-container" class="mt-0">
                        <ul class="tabs-menu mt-0">
                            <li class="current"><a href="#tab-1">Login</a></li>
                            <li><a href="#tab-2">Register</a></li>
                        </ul>
                        <div class="tab">
                            <div id="tab-1" class="tab-contents">
                                <div class="custom-form">
                                    <form method="post" name="registerform">
                                        <input name="email" type="text" placeholder="Email" id="email">
                                        
                                        <button type="submit" class="log-submit-btn"><span>Log In</span></button>
                                        <div class="clearfix"></div>
                                    </form>
                                    <div class="lost_password">
                                        <a href="#">Lost Your Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <div id="tab-2" class="tab-contents">
                                    <div class="custom-form">
                                        <form method="post" name="registerform" class="main-register-form" id="main-register-form2">
                                             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                            <input name="name" type="text" onClick="this.select()" value="" placeholder="Name">
                                            <input name="name2" type="text" onClick="this.select()" value="" placeholder="Email">
                                            <input name="email" type="password" onClick="this.select()" value="" placeholder="Password">
                                            <input name="password" type="text" onClick="this.select()" value="" placeholder="Mobile Number">
                                            <button type="submit" class="log-submit-btn"><span>Register</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--register form end -->

        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
    </div>
        <!-- END PRELOADER -->

        <!-- ARCHIVES JS -->
        <script src="<?= asset_url();?>js/jquery-3.5.1.min.js"></script>
        <script src="<?= asset_url();?>js/rangeSlider.js"></script>
        <script src="<?= asset_url();?>js/tether.min.js"></script>
        <script src="<?= asset_url();?>js/moment.js"></script>
        <script src="<?= asset_url();?>js/bootstrap.min.js"></script>
        <script src="<?= asset_url();?>js/mmenu.min.js"></script>
        <script src="<?= asset_url();?>js/mmenu.js"></script>
        <script src="<?= asset_url();?>js/aos.js"></script>
        <script src="<?= asset_url();?>js/aos2.js"></script>
        <script src="<?= asset_url();?>js/animate.js"></script>
        <script src="<?= asset_url();?>js/slick.min.js"></script>
        <script src="<?= asset_url();?>js/fitvids.js"></script>
        <script src="<?= asset_url();?>js/jquery.waypoints.min.js"></script>
        <script src="<?= asset_url();?>js/typed.min.js"></script>
        <script src="<?= asset_url();?>js/jquery.counterup.min.js"></script>
        <script src="<?= asset_url();?>js/imagesloaded.pkgd.min.js"></script>
        <script src="<?= asset_url();?>js/isotope.pkgd.min.js"></script>
        <script src="<?= asset_url();?>js/smooth-scroll.min.js"></script>
        <script src="<?= asset_url();?>js/lightcase.js"></script>
        <script src="<?= asset_url();?>js/search.js"></script>
        <script src="<?= asset_url();?>js/owl.carousel.js"></script>
        <script src="<?= asset_url();?>js/jquery.magnific-popup.min.js"></script>
        <script src="<?= asset_url();?>js/ajaxchimp.min.js"></script>
        <script src="<?= asset_url();?>js/newsletter.js"></script>
        <script src="<?= asset_url();?>js/jquery.form.js"></script>
        <script src="<?= asset_url();?>js/jquery.validate.min.js"></script>
        <script src="<?= asset_url();?>js/searched.js"></script>
        <script src="<?= asset_url();?>js/forms-2.js"></script>
        <script src="<?= asset_url();?>js/map-style2.js"></script>
        <script src="<?= asset_url();?>js/range.js"></script>
        <script src="<?= asset_url();?>js/color-switcher.js"></script>
        <script src="<?= asset_url();?>js/jquery.validate.js"></script>

        <script src="<?= asset_url();?>js/jquery-ui.js"></script>
        <script src="<?= asset_url();?>js/range-slider.js"></script>
        <script src="<?= asset_url();?>js/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
    $('select').select2();
});
</script> -->
      
  <!--       <script src="<?= asset_url();?>js/slick4.js"></script>
        <script src="<?= asset_url();?>js/newsletter.js"></script>
        <script src="<?= asset_url();?>js/timedropper.js"></script>
        <script src="<?= asset_url();?>js/datedropper.js"></script>
        <script src="<?= asset_url();?>js/leaflet.js"></script>
        <script src="<?= asset_url();?>js/leaflet-gesture-handling.min.js"></script>
        <script src="<?= asset_url();?>js/leaflet-providers.js"></script>
        <script src="<?= asset_url();?>js/leaflet.markercluster.js"></script>
        <script src="<?= asset_url();?>js/map-single.js"></script>
 <script src="<?= asset_url();?>js/inner.js"></script> -->
        <script>
            $(window).on('scroll load', function() {
                $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
            });
/* Autocomplete */
 $(document).ready(function() {
    $("#area").keyup(function() {
      var auto = $(this).val();     
      if(auto !="") {
        $.ajax({
          method : "POST",
          url : "<?= base_url().'home/autocomplete';?>",
          dataType: "html",
          data : {auto : auto, "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},
          dataType:"json",
          beforeSend:function() {
          $("#auto").html("<div class='text-info'>Loading...</div>");
          },
          success:function(data) {
            $("#auto").slideDown(30).html(data.msg);
             $(".csrf_token").val(data.csrf_token);
          }
        });
      }else {
        $("#auto").html("<h5 style='text-align:center;margin:10px 0px;font-weight:bold'>No results</h5>");
            $("#auto").slideUp(30).html("");
      }
    });
  });

$(document).on("click", "#autocompletebtnn", function () {
    $("#area").val($(this).text());
    $("#auto").html("");
  });
        </script>
 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">

        <!-- Slider Revolution scripts -->
        <script src="<?= asset_url();?>revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.carousel.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.migration.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.parallax.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="<?= asset_url();?>revolution/js/extensions/revolution.extension.video.min.js"></script>
          <script>
            var tpj = jQuery;
            var revapi486;
            tpj(document).ready(function() {
                if (tpj("#rev_slider_one").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_one");
                } else {
                    revapi486 = tpj("#rev_slider_one").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "plugins/revolution/js/",
                        sliderLayout: "fullwidth",
                        dottedOverlay: "yes",
                        delay: 10000,
                        navigation: {
                            keyboardNavigation: "off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            mouseScrollReverse: "default",
                            onHoverStop: "off",
                            touch: {
                                touchenabled: "on",
                                touchOnDesktop: "off",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            },
                            arrows: {
                                style: "metis",
                                enable: true,
                                hide_onmobile: true,
                                hide_under: 600,
                                hide_onleave: false,
                                tmp: '',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 0,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 0,
                                    v_offset: 0
                                }
                            }

                        },
                        responsiveLevels: [1200, 1040, 778, 480],
                        visibilityLevels: [1200, 1040, 778, 480],
                        gridwidth: [1170, 1040, 778, 600],
                        gridheight: [650, 650, 650, 950],
                        lazyType: "none",
                        parallax: {
                            type: "scroll",
                            origo: "enterpoint",
                            speed: 400,
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 46, 47, 48, 49, 50, 55]
                        },
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "on",
                        stopAfterLoops: 0,
                        stopAtSlide: 0,
                        disableProgressBar: "on",
                        shuffle: "off",
                        autoHeight: "off",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
                }
            }); /*ready*/

        </script>

        <script>
            var typed = new Typed('.typed', {
                strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
                smartBackspace: false,
                loop: true,
                showCursor: true,
                cursorChar: "|",
                typeSpeed: 50,
                backSpeed: 30,
                startDelay: 800
            });
              $(document).ready(function() {
                $(document).on("click",'#favourites',function(e) {

                   
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        url :"<?= base_url().'home/wishlist'; ?>",
                        method:"post",
                        data:{
                            id:id,
                            "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                        },
                        dataType:"json",
                        success:function(data) {
                            if(data.status ==true) {
                                $(".csrf_token").val(data.csrf_token);
                                $('#wish'+id).addClass('favourite');

                            }else if(data.status ==false) {
                                window.location.href="<?= base_url().'login';?>";
                            }
                        }
                    });
                });
            });

        </script>

        <script>
            $('.slick-lancers').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1292,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }]
            });

        </script>

        <script>
            $('.job_clientSlide').owlCarousel({
                items: 2,
                loop: true,
                margin: 30,
                autoplay: false,
                nav: true,
                smartSpeed: 1000,
                slideSpeed: 1000,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    991: {
                        items: 3
                    }
                }
            });

        </script>

        <script>
            $('.style2').owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                autoWidth: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2,
                        margin: 20
                    },
                    400: {
                        items: 2,
                        margin: 20
                    },
                    500: {
                        items: 3,
                        margin: 20
                    },
                    768: {
                        items: 4,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 20
                    },
                    1000: {
                        items: 7,
                        margin: 20
                    }
                }
            });

        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });

            $(document).ready(function() {
                $("#ssubmit").on("click",function(e) {
                    e.preventDefault();
                        var emailid = $("#subscribeEmail").val();
                        if(emailid =="") {
                            $(".successerror").html("<div class='alert alert-danger'>Email is required</div>");
                            return false;
                        }else {
                            $.ajax({
                                url :"<?= base_url().'home/newsletter'; ?>",
                                method:"post",
                                data :{
                                    email:emailid,
                                    "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                                },
                                dataType:"json",
                                success:function(data) {
                                    if(data.status ==true) {
                                         $(".csrf_token").val(data.csrf_token);
                                        $(".successerror").html(data.msg);
                                    }
                                    else if(data.status ==false) {
                                         $(".csrf_token").val(data.csrf_token);
                                         $(".successerror").html(data.msg);
                                    }
                                }
                            });
                        }
                });
            });

        </script>

        <!-- MAIN JS -->
        <script src="<?= asset_url();?>js/script.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    </div>
    <!-- Wrapper / End -->
</body>


<!-- Mirrored from code-theme.com/html/sqft9/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 May 2022 08:21:48 GMT -->
</html>