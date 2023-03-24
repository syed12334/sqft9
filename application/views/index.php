<?php //echo "<pre>";print_r($contact);exit; ?>
<?= $header;?>
<style type="text/css">
   .tp-bgimg.defaultimg {
    opacity: 1!important;
}
</style>


<!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
<section class="main-slider">
            <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
                <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                    <ul>
                        <?php
                            if(count($sliders)) {
                                foreach ($sliders as $key => $value) {
                                  ?>
                                   <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1689" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="<?= base_url().$value->image;?>" data-title="Slide Title" data-transition="parallaxvertical">

                            <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-kenburns="off" data-duration="10000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" src="<?= base_url().$value->image;?>">

                        </li>
                                  <?php
                                }
                            }
                        ?>
                       

                      
                    </ul>
                </div>
            </div>
        </section>


        
        <!-- STAR HEADER SEARCH -->
        <section id="hero-area">
            <div class="hero-main">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-inner">
                                <!-- Welcome Text -->
                                <div class="welcome-text text-center">
                                    <h1 class="h1">Find Your Dream
                                    <br class="d-md-none">
                                    <span class="typed border-bottom"></span>
                                </h1>
                                    <p class="mt-1">Search Properties</p>
                                </div>
                                <!--/ End Welcome Text -->
                                <!-- Search Form -->
                                <div class="col-12">
                                    <div class="banner-search-wrap">
                                       <!-- <ul class="nav nav-tabs rld-banner-tab">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabs_1">For Sale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabs_2">For Rent</a>
                                            </li>
                                        </ul>-->
                                        <div class="tab-content">
                                             <form action="<?= base_url().'home/search';?>" method="post">
                                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                            <div class="tab-pane fade show active" id="tabs_1">
                                                <div class="rld-main-search">
                                                    <div class="row">
                                                        <div class="rld-single-input  col-md-3  pl-1 pr-1">
                                                            <input type="text" placeholder="Enter Location or Keyword" name="location" id="location">
                                                        </div>

                                                         <div class="rld-single-input col-md-3  pl-1 pr-1">
                                                            <input type="text" placeholder="Enter Specific Area " name="area" id="area">
                                                            <div id="auto">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="rld-single-select  col-md-3  pl-1 pr-1">
                                                            <select class="select single-select" name="pcat" id="pcat" >
                                                                <option value="">Property Category</option>
                                                                <?php 
                                                                    if(count($pcategory) >0) {
                                                                        foreach ($pcategory as $key => $value) {
                                                                            ?>
                                                                            <option value="<?= $value->id?>"><?= $value->name?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="rld-single-select col-md-3  pl-1 pr-1">
                                                            <select class="select single-select" name="ptype" id="ptype" style="width: 65%!important;margin-right: 0!important;">
                                                                <option value="">Property Type</option>
                                                                   <?php 
                                                                    if(count($ptype) >0) {
                                                                        foreach ($ptype as $p) {
                                                                            ?>
                                                                            <option value="<?= $p->id?>"><?= $p->name?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                            <button type="submit"  class="btn btn-yellow" id="submit" > <i class="fa fa-search"></i> </button >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                            <div class="tab-pane fade" id="tabs_2">
                                                <div class="rld-main-search">
                                                    <div class="row">
                                                        <div class="rld-single-input">
                                                            <input type="text" placeholder="Enter Keyword...">
                                                        </div>
                                                        <div class="rld-single-select ml-22">
                                                            <select class="select single-select">
                                                                <option value="1">Property Type</option>
                                                                <option value="2">Family House</option>
                                                                <option value="3">Apartment</option>
                                                                <option value="3">Condo</option>
                                                            </select>
                                                        </div>
                                                        <div class="rld-single-select">
                                                            <select class="select single-select mr-0">
                                                                <option value="1">Location</option>
                                                                <option value="2">Los Angeles</option>
                                                                <option value="3">Chicago</option>
                                                                <option value="3">Philadelphia</option>
                                                                <option value="3">San Francisco</option>
                                                                <option value="3">Miami</option>
                                                                <option value="3">Houston</option>
                                                            </select>
                                                        </div>
                                                        <div class="dropdown-filter"><span>Advanced Search</span></div>
                                                        <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                            <a class="btn btn-yellow" href="#">Search Now</a>
                                                        </div>
                                                        <div class="explore__form-checkbox-list full-filter">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                                    <!-- Form Property Status -->
                                                                    <div class="form-group categories">
                                                                        <div class="nice-select form-control wide" tabindex="0"><span class="current"><i class="fa fa-home"></i>Property Status</span>
                                                                            <ul class="list">
                                                                                <li data-value="1" class="option selected ">For Sale</li>
                                                                                <li data-value="2" class="option">For Rent</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--/ End Form Property Status -->
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                                    <!-- Form Bedrooms -->
                                                                    <div class="form-group beds">
                                                                        <div class="nice-select form-control wide" tabindex="0"><span class="current"><i class="fa fa-bed" aria-hidden="true"></i> Bedrooms</span>
                                                                            <ul class="list">
                                                                                <li data-value="1" class="option selected">1</li>
                                                                                <li data-value="2" class="option">2</li>
                                                                                <li data-value="3" class="option">3</li>
                                                                                <li data-value="3" class="option">4</li>
                                                                                <li data-value="3" class="option">5</li>
                                                                                <li data-value="3" class="option">6</li>
                                                                                <li data-value="3" class="option">7</li>
                                                                                <li data-value="3" class="option">8</li>
                                                                                <li data-value="3" class="option">9</li>
                                                                                <li data-value="3" class="option">10</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--/ End Form Bedrooms -->
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
                                                                    <!-- Form Bathrooms -->
                                                                    <div class="form-group bath">
                                                                        <div class="nice-select form-control wide" tabindex="0"><span class="current"><i class="fa fa-bath" aria-hidden="true"></i> Bathrooms</span>
                                                                            <ul class="list">
                                                                                <li data-value="1" class="option selected">1</li>
                                                                                <li data-value="2" class="option">2</li>
                                                                                <li data-value="3" class="option">3</li>
                                                                                <li data-value="3" class="option">4</li>
                                                                                <li data-value="3" class="option">5</li>
                                                                                <li data-value="3" class="option">6</li>
                                                                                <li data-value="3" class="option">7</li>
                                                                                <li data-value="3" class="option">8</li>
                                                                                <li data-value="3" class="option">9</li>
                                                                                <li data-value="3" class="option">10</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--/ End Form Bathrooms -->
                                                                </div>
                                                                <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                                    <!-- Price Fields -->
                                                                    <div class="main-search-field-2">
                                                                        <!-- Area Range -->
                                                                        <div class="range-slider">
                                                                            <label>Area Size</label>
                                                                            <div id="area-range-rent" data-min="0" data-max="1300" data-unit="sq ft"></div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <br>
                                                                        <!-- Price Range -->
                                                                        <div class="range-slider">
                                                                            <label>Price Range</label>
                                                                            <div id="price-range-rent" data-min="0" data-max="600000" data-unit="$"></div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                    <!-- Checkboxes -->
                                                                    <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                                        <input id="check-16" type="checkbox" name="check">
                                                                        <label for="check-16">Air Conditioning</label>
                                                                        <input id="check-17" type="checkbox" name="check">
                                                                        <label for="check-17">Swimming Pool</label>
                                                                        <input id="check-18" type="checkbox" name="check">
                                                                        <label for="check-18">Central Heating</label>
                                                                        <input id="check-19" type="checkbox" name="check">
                                                                        <label for="check-19">Laundry Room</label>
                                                                        <input id="check-20" type="checkbox" name="check">
                                                                        <label for="check-20">Gym</label>
                                                                        <input id="check-21" type="checkbox" name="check">
                                                                        <label for="check-21">Alarm</label>
                                                                        <input id="check-22" type="checkbox" name="check">
                                                                        <label for="check-22">Window Covering</label>
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                    <!-- Checkboxes -->
                                                                    <div class="checkboxes one-in-row margin-bottom-10 ch-2">
                                                                        <input id="check-23" type="checkbox" name="check">
                                                                        <label for="check-23">WiFi</label>
                                                                        <input id="check-24" type="checkbox" name="check">
                                                                        <label for="check-24">TV Cable</label>
                                                                        <input id="check-25" type="checkbox" name="check">
                                                                        <label for="check-25">Dryer</label>
                                                                        <input id="check-26" type="checkbox" name="check">
                                                                        <label for="check-26">Microwave</label>
                                                                        <input id="check-27" type="checkbox" name="check">
                                                                        <label for="check-27">Washer</label>
                                                                        <input id="check-28" type="checkbox" name="check">
                                                                        <label for="check-28">Refrigerator</label>
                                                                        <input id="check-29" type="checkbox" name="check">
                                                                        <label for="check-29">Outdoor Shower</label>
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Search Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HEADER SEARCH -->

         
        
        <!-- START SECTION POPULAR PLACES -->
        <section class="feature-categories bg-white rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Recent </span>Properties</h2>
                    <p>Properties In Most Popular Places.</p>
                </div>
                <div class="row">
                   <?php
                        if(count($popularplaces) >0) {
                            foreach ($popularplaces as $key => $places) {
                                $id = $places->id;
                                $getImg = $this->master_db->sqlExecute('select p_img from property_gallery where prid='.$id.' order by id asc limit 1');
                               ?>
                                  <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="small-category-2">
                            <div class="small-category-2-thumb img-1">

                                <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                        <a href="<?= base_url().$places->slug;?>"><img src="<?php if(!empty($getImg[0]->p_img)) {echo base_url().$getImg[0]->p_img;} ?>" alt=""></a>
                                        <?php
                                    }else {
                                        ?>
                                        <a href="<?= base_url().'propertydetails/'.$places->slug;?>"><img src="<?php if(!empty($getImg[0]->p_img)) {echo base_url().$getImg[0]->p_img;} ?>" alt=""></a>
                                        <?php
                                    }
                                ?>
                                
                            </div>
                            <div class="sc-2-detail">
                                <h4 class="sc-jb-title">
                                    <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                         <a href="<?= base_url().$places->slug;?>"><?= $places->title; ?></a>
                                        <?php
                                    }else {
                                        ?>
                                         <a href="<?= base_url().'propertydetails/'.$places->slug;?>"><?= $places->title; ?></a>
                                        <?php
                                    }
                                    ?>
                                   </h4>
                            </div>
                        </div>
                    </div>
                               <?php
                            }
                        }
                    ?>
                </div>
                <!-- /row -->
            </div>
        </section>
        <!-- END SECTION POPULAR PLACES -->

        <!-- START SECTION FEATURED PROPERTIES -->
        <section class="featured portfolio bg-white-2 rec-pro full-l">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Featured </span>Properties</h2>
                    <p>These are our featured properties</p>
                </div>
                <div class="row portfolio-items">
                      <?php
                        if(count($featureproperties) >0) {
                            foreach ($featureproperties as $key => $feature) {
                                $id = $feature->id;
                                $pid = $feature->pid;
                                $getPackage = $this->master_db->getRecords('packages',['id'=>$pid],'type');
                                $type = "";
                                if(is_array($getPackage) && !empty($getPackage)) {
                                     if($getPackage[0]->type ==1) {
                                            $type .="Rent";
                                        }else if($getPackage[0]->type ==2) {
                                             $type .="Sale";
                                        }
                                }
                               
                                $getImg = $this->master_db->sqlExecute('select p_img from property_gallery where prid='.$id.' order by id desc limit 1');
                                    ?>
                                                                         <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-right">

                              <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                         <a href="<?= base_url().$feature->slug;?>" class="project-inner project-head">
                                        <?php

                                    }else {
                                        ?>
                                         <a href="<?= base_url().'propertydetails/'.$feature->slug;?>" class="project-inner project-head">
                                        <?php
                                    }

                                    ?>
                           
                                <div class="homes">
                                    <!-- homes img -->
                                    <div  class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <img src="<?php if(!empty($getImg[0]->p_img)) {echo base_url().$getImg[0]->p_img;} ?>" alt="home-1" class="img-responsive">
                                    </div>
                                </div>
                             
                            </a>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                  <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                              <h3><a href="<?= base_url().$feature->slug;?>"><?= $feature->title;?></a></h3>
                                        <?php
                                    }else {
                                        ?>
                                         <h3><a href="<?= base_url().'propertydetails/'.$feature->slug;?>"><?= $feature->title;?></a></h3>
                                        <?php
                                    }
                                    ?>
                              
                                <p class="homes-address mb-3">
                                    <?php
                                        if(!empty($feature->paddress)) {
                                            ?>
                                                 <a href="#">
                                        <i class="fa fa-map-marker"></i><span><?= substr($feature->paddress,0,60).'...';?></span>
                                    </a>
                                            <?php 
                                        }
                                    ?>
                                   
                                </p>
                                <!-- homes List -->
                                                            <ul class="homes-list clearfix">
                                                                        <li>
                                    <span class="font-weight-bold mr-1">Type:</span>
                                    <span class="det"><?php
                                        if(!empty($feature->ptype)) {

                                            if($feature->ptype ==1) {
                                                echo 'Apartment';
                                            }
                                             else if($feature->ptype ==2) {
                                                echo 'House';
                                            }
                                             else if($feature->ptype ==3) {
                                                echo 'Office Space';
                                            }
                                             else if($feature->ptype ==4) {
                                                echo 'Commercial ';
                                            }
                                             else if($feature->ptype ==5) {
                                                echo 'Plot & Land';
                                            }
                                             else if($feature->ptype ==6) {
                                                echo 'Shop';
                                            }

                                             else if($feature->ptype ==7) {
                                                echo 'Building';
                                            }

                                     
                                        }
                                    ?></span>
                                </li>
                             <li>
                                    <span class="font-weight-bold mr-1">Facing:</span>
                                    <span class="det"><?php
                                        if(!empty($feature->face)) {
                                         echo $feature->face;
                                        }
                                    ?></span>
                                </li>
                    
                            </ul>
                                <div class="price-properties footer pt-3 pb-0">
                                    <h3 class="title mt-3">
                                        <?php if(!empty($feature->price)) {
                                            ?>
                                             <a href="#"><i class="fa fa-rupee-sign"></i> <?php
                                        echo number_format($feature->price); 
                                    ?></a>
                                            <?php
                                        }
                                        ?>
                                    
                                    </h3>
                                    <div class="compare">
                                          <?php
                                        if(!empty($feature->videotype) && $feature->videotype !="") {
                                            if($feature->videotype ==1) {
                                                ?>
                                               <a href="<?= base_url().$feature->video_path?>" class="btn popup-video popup-youtube" style="display: inline-block;
    color: #fff;
    box-shadow: none;
    padding: 0;
    margin-right: 15px;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    line-height: 33px;
    background: rgba(74,74,76,0.7);
    z-index: 1;"><i class="fas fa-video" style="color:#fff!important;    margin-left: 7px;"></i>  </a>
                                                <?php
                                            }
                                            else if($feature->videotype ==2) {
                                                ?>
                                                <a href="https://www.youtube.com/watch?v=<?= $feature->video_path;?>" class="btn popup-video popup-youtube" style="display: inline-block;
    color: #fff;
    box-shadow: none;
    padding: 0;
    margin-right: 15px;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    line-height: 33px;
    background: rgba(74,74,76,0.7);
    z-index: 1;"><i class="fas fa-video" style="color:#fff!important;    margin-left: 7px;"></i></a>
                                                <?php
                                            }
                                        }
                                    ?>
                                      <!--   <a href="#" title="Share">
                                            <i class="flaticon-share"></i>
                                        </a> -->

                                        <a data-toggle="collapse" href="#collapseExample<?= $feature->id;?>" role="button" aria-expanded="false" aria-controls="collapseExample" class="share" title="Share"><i class="flaticon-share"></i></a>

                                <div class="collapse share-a" id="collapseExample<?= $feature->id;?>" style="bottom: 50px!important">
                                    <div class=" p-0">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url().$feature->slug;?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                        <a href="http://twitter.com/share?text=?&url=<?= base_url().$feature->slug;?>&hashtags=#gogarbha"  target="_blank"class="twitter"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                                             <a href="javascript:void(0)" id="favourites" title="Favorites" data-id="<?= sqftEncrypt($feature->id);?>" >
                                            <i class="flaticon-heart" id="wish<?= sqftEncrypt($feature->id);?>"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    <?php

                                    }
                                }

                                ?>


                </div>
            
            </div>
        </section>
        <!-- END SECTION FEATURED PROPERTIES -->

        <!-- START SECTION WHY CHOOSE US -->
        <section class="how-it-works bg-white rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Why </span>Choose Us</h2>
                    <p>We provide full service at every step.</p>
                </div>
                <div class="row service-1">
                    <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                        <div class="serv-flex">
                            <div class="art-1 img-13">
                                <img src="<?= asset_url();?>images/icons/icon-4.svg" alt="">
                                <h3>Wide Renge Of Properties</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">Sqft9 provides wide range of properties to fulfill your Residential and Commercial needs. Searching is easy and convenient on our portal.</p>
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="250">
                        <div class="serv-flex">
                            <div class="art-1 img-14">
                                <img src="<?= asset_url();?>images/icons/icon-5.svg" alt="">
                                <h3>Trusted by thousands</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">Sqft9 offer cheaper package which in your budget and help to promote your property on Global Market.</p>
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-3 col-md-6 col-xs-12 serv mb-0 pt" data-aos="fade-up" data-aos-delay="350">
                        <div class="serv-flex arrow">
                            <div class="art-1 img-15">
                                <img src="<?= asset_url();?>images/icons/icon-6.svg" alt="">
                                <h3>Financing made easy</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">Sqft9 is a platform that brings together residents, owners and tenants in one place.</p>
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-3 col-md-6 col-xs-12 serv mb-0 pt its-2" data-aos="fade-up" data-aos-delay="450">
                        <div class="serv-flex">
                            <div class="art-1 img-14">
                                <img src="<?= asset_url();?>images/icons/icon-15.svg" alt="">
                                <h3>We are here near you</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">Sqft9 helps to find and connect with right and genuine buyer also right seller</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- END SECTION WHY CHOOSE US -->        

        <!-- START SECTION RECENTLY PROPERTIES -->
        <section class="featured portfolio rec-pro disc" style="background: #0e183c!important;">
            <div class="container-fluid">
                <div class="sec-title discover">
                    <h2><span>Discover </span>Popular Properties</h2>
                    <p>We provide full service at every step.</p>
                </div>
                <div class="portfolio col-xl-12">
                    <div class="slick-lancers">

                          <?php
                        if(count($popularproperties) >0) {
                            foreach ($popularproperties as $key => $popular) {
                                $id = $popular->id;
                                $pid = $popular->pid;
                                $getPackage = $this->master_db->getRecords('packages',['id'=>$pid],'type');
                                $type = "";
                                if(is_array($getPackage) && !empty($getPackage)) {
                                if($getPackage[0]->type ==1) {
                                    $type .="Rent";
                                }else if($getPackage[0]->type ==2) {
                                     $type .="Sale";
                                }
                            }
                                $getImg = $this->master_db->sqlExecute('select p_img from property_gallery where prid='.$id.' order by id asc limit 1');
                                    ?>
                                                                                   <div class="agents-grid" data-aos="fade-up" data-aos-delay="150">
                            <div class="landscapes">
                                <div class="project-single">

                                       <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                         <a href="<?= base_url().$places->slug;?>"  class="project-inner project-head">
                                        <?php
                                    }else {
                                        ?>
                                         <a href="<?= base_url().'dashboard/propertyview/'.$places->slug;?>"  class="project-inner project-head">
                                        <?php
                                    }

                                    ?>
                                   
                                        <div class="homes">
                                            <!-- homes img -->
                                            <div class="homes-img">
                                                <div class="homes-tag button alt sale">For <?= $type;?></div>
                                                <img src="<?php if(!empty($getImg[0]->p_img)) {echo base_url().$getImg[0]->p_img;} ?>" alt="home-1" class="img-responsive">
                                            </div>
                                        </div>
                                       
                                    </a>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                         <?php
                                    if(!$this->session->userdata(ADMIN_SESSION)) {
                                        ?>
                                         <h3><a href="<?= base_url().$places->slug;?>"><?= $popular->title;?></a></h3>
                                        <?php
                                    }else {
                                        ?>
                                                 <h3><a href="<?= base_url().'propertydetails/'.$places->slug;?>"><?= $popular->title;?></a></h3>
                                        <?php
                                    }
                                    ?>
                                       
                                        <p class="homes-address mb-3">
                                               <a href="#">
                                        <i class="fa fa-map-marker"></i>
                                            <?php
                                        if(!empty($popular->paddress)) {
                                            ?>
                                              <span><?= substr($popular->paddress,0,30).'...';?></span>
                                
                                            <?php 
                                        }
                                    ?>
                                        </a>
                                        </p>
                                        <!-- homes List -->
                                                          <ul class="homes-list clearfix">
                                                              <li>
                                    <span class="font-weight-bold mr-1">Type:</span>
                                    <span class="det"><?php
                                        if(!empty($popular->ptype)) {

                                            if($popular->ptype ==1) {
                                                echo 'Apartment';
                                            }
                                             else if($popular->ptype ==2) {
                                                echo 'House';
                                            }
                                             else if($popular->ptype ==3) {
                                                echo 'Office Space';
                                            }
                                             else if($popular->ptype ==4) {
                                                echo 'Commercial ';
                                            }
                                             else if($popular->ptype ==5) {
                                                echo 'Plot & Land';
                                            }
                                             else if($popular->ptype ==6) {
                                                echo 'Shop';
                                            }

                                             else if($popular->ptype ==7) {
                                                echo 'Building';
                                            }

                                     
                                        }
                                    ?></span>
                                </li>
                                <li>
                                    <span class="font-weight-bold mr-1">Facing:</span>
                                    <span class="det"><?php
                                        if(!empty($popular->face)) {
                                         echo $popular->face;
                                        }
                                    ?></span>
                                </li>
                              
            
                            </ul>
                                        <div class="price-properties footer pt-3 pb-0">
                                            <h3 class="title mt-3">
                                                <?php if(!empty($popular->price)) {
                                                        ?>
                                                            <a href="#"><i class="fa fa-rupee-sign"></i> <?php 
                                       echo  number_format($popular->price); 
                                     ?></a>
                                                        <?php
                                                }
                                                    ?>
                                            
                                            </h3>
                                            <div class="compare">
                                              <?php
                                        if(!empty($popular->videotype) && $popular->videotype !="") {
                                            if($popular->videotype ==1) {
                                                ?>
                                               <a href="<?= base_url().$popular->video_path?>" class="btn popup-video popup-youtube" style="display: inline-block;
    color: #fff;
    box-shadow: none;
    padding: 0;
    margin-right: 15px;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    line-height: 33px;
    background: rgba(74,74,76,0.7);
    z-index: 1;"><i class="fas fa-video" style="color:#fff!important;    margin-left: 7px;"></i>  </a>
                                                <?php
                                            }
                                            else if($popular->videotype ==2) {
                                                ?>
                                                <a href="https://www.youtube.com/watch?v=<?= $popular->video_path;?>" class="btn popup-video popup-youtube" style="display: inline-block;
    color: #fff;
    box-shadow: none;
    padding: 0;
    margin-right: 15px;
    border-radius: 8px;
    width: 36px;
    height: 36px;
    line-height: 33px;
    background: rgba(74,74,76,0.7);
    z-index: 1;"><i class="fas fa-video" style="color:#fff!important;    margin-left: 7px;"></i></a>
                                                <?php
                                            }
                                        }
                                    ?>
                                             
                                        <a data-toggle="collapse" href="#collapseExample<?= $popular->id?>" role="button" aria-expanded="false" aria-controls="collapseExample" class="share" title="Share"><i class="flaticon-share"></i></a>

                                <div class="collapse share-a" id="collapseExample<?= $popular->id?>" style="bottom:50px">
                                    <div class=" p-0">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url().$popular->slug;?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                        <a href="http://twitter.com/share?text=?&url=<?= base_url().$popular->slug;?>&hashtags=#gogarbha"  target="_blank"class="twitter"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                                                 <a href="javascript:void(0)" id="favourites" title="Favorites" data-id="<?= sqftEncrypt($popular->id);?>" >
                                            <i class="flaticon-heart" id="wish<?= sqftEncrypt($popular->id);?>"></i>
                                        </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <?php
                                }
                            }
                            ?>

                 
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION RECENTLY PROPERTIES -->

       

        <!-- START SECTION TESTIMONIALS -->
        <section class="testimonials bg-white-2 rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Clients </span>Testimonials</h2>
                    <p>We collect reviews from our customers.</p>
                </div>
                <div class="owl-carousel job_clientSlide">

                    <?php
                        if(count($testimonials)) {
                            foreach ($testimonials as $test) {
                               ?>
                                  <div class="singleJobClinet" data-aos="zoom-in" data-aos-delay="150">
                        <p>
                            <?= $test->tdesc;?>
                        </p>
                        <div class="detailJC">
                            <span><img src="<?= base_url().$test->image;?>" alt=""/></span>
                            <h5><?= ucfirst($test->name);?></h5>
                            <p><?= ucfirst($test->location);?></p>
                        </div>
                    </div>
                               <?php
                            }
                        }
                    ?>
                  
                    
                </div>
            </div>
        </section>
        <!-- END SECTION TESTIMONIALS -->

        <!-- STAR SECTION PARTNERS -->
        <div class="partners bg-white rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Our </span>Partners</h2>
                    <p>The Companies That Represent Us.</p>
                </div>
                <div class="owl-carousel style2">
                   
                    
                    <?php
                        if(count($partners) >0) {
                            foreach ($partners as $partner) {
                                ?>
                                <div class="owl-item" data-aos="fade-up"><img src="<?= base_url().$partner->image;?>" alt=""></div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- END SECTION PARTNERS -->


<?= $footer;?>
