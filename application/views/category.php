<?php
//echo "<pre>";print_r($ptype);exit;
        
 ?>

<?= $header;?>
<style type="text/css">
    .parallax-searchs.home15 {
  background: none!important;
  background: none!important;
  background-size: cover;
  background-attachment: fixed !important;
  width: 100%;
  position: relative;
  
}

.parallax-searchs.home15.thome-6 {
  background: none!important;
  background: none!important;
  background-size: cover;
  background-attachment: fixed !important;
  width: 100%;
  position: relative;
  z-index: 99;
  position: relative;
  height: 46vh!important
}

.parallax-searchs.thome-1 {
  background: none!important;
  background: none!important;
  background-size: cover;
  background-attachment: fixed !important;
  width: 100%;
  position: relative;
  height: none!important
}
.parallax-searchs.thome-10 {
  background: none!important;
  background: none !important;
  background-size: cover;
  background-attachment: fixed !important;
  width: 100%;
 height: none!important}

.parallax-searchs.home15.thome-10 .hero-inner {
  text-align: center;
  padding: 150px 0px 100px 0px !important;
}

.parallax-searchs.home15.thome-6 .hero-inner {
  text-align: center;
  padding: 150px 0px 100px 0px!important;
}
.parallax-searchs .welcome-text h1 {
        font-size: 36px;
    color: #000!important;
    text-transform: capitalize;
}
.hp-6 .btn.btn-yellow {
    margin-left:10px;
    height: 45px!important;
}
.btn.btn-yellow {
    line-height: 40px!important
}
.parallax-searchs.home15 .welcome-text p {
    color:#000!important;
}
 .radios label {
    display: inline-block;
width:100%;
    color: #898989;

  }
</style>
        <section id="hero-area" class="parallax-searchs home15 overlay thome-6 thome-1" data-stellar-background-ratio="0.5">
            <div class="hero-main">
                <div class="container" data-aos="zoom-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-inner">
                                <!-- Welcome Text -->
                                <div class="welcome-text">
                                    <h1 class="h1">Find Your Dream
                                    <br class="d-md-none">
                                    <span class="typed border-bottom"></span>
                                </h1>
                            <p class="mt-4">Search Properties</p>
                                    
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
                                                            <button type="submit"  class="btn btn-yellow ml-0" id="submit" > <i class="fa fa-search"></i> </button >
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

          <!-- START SECTION PROPERTIES LISTING -->
        <section class="properties-right featured portfolio blog pt-5" style="margin-top: 50px">
            <div class="container-fluid">
                
                <div class="row">

                    <aside class="col-lg-3 col-md-12 car">
                        <div class="widget">
                            <!-- Search Fields -->
                            <div class="widget-boxed main-search-field">
                                <div class="widget-boxed-header">
                                    <h4>Find Your House</h4>
                                </div>
                                
                            
                                
                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Amenities" data-close-title="Amenities"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <?php
                                            if(count($amenities) >0) {
                                                foreach ($amenities as $amenity) {
                                                    ?>
                                                     <input id="check-<?php echo $amenity->id;?>" type="checkbox" name="amenities[]" class="checkedbox getamenity" value="<?php echo $amenity->id;?>">
                                        <label for="check-<?php echo $amenity->id;?>"><?php echo $amenity->title;?></label>
                                                    <?php
                                                }
                                            } 
                                        ?>
                                       
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>




                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Bhk" data-close-title="Bhk"></a>

                                <div class="more-search-options relative">
                                    <!-- radios -->
                                    <div class="radios one-in-row margin-bottom-10">
                                        <label for="check-100"><input id="check-100" type="radio" name="getbhk[]" value="1" class="radiobox checkedbox getbhk">
                                        1 Bhk</label>
                                       <label for="check-101"> <input id="check-101" type="radio" name="getbhk[]" value="2" class="radiobox checkedbox getbhk">
                                        2 Bhk</label>
                                        <label for="check-102"><input id="check-102" type="radio" name="getbhk[]" value="3" class="radiobox checkedbox getbhk">
                                        3 Bhk</label>
                                    </div>
                                    <!-- radios / End -->
                                </div>
                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Facing" data-close-title="Facing"></a>
                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="radios  one-in-row margin-bottom-10">
                                       <label for="check-120" > <input id="check-120" type="radio" name="facing[]" class="radiobox checkedbox getfacing" value="East">
                                        East</label>
                                        <label for="check-121" ><input id="check-121" type="radio" name="facing[]" class="radiobox checkedbox getfacing" value="West">
                                        West</label>
                                        <label for="check-122"><input id="check-122" type="radio" name="facing[]" class="radiobox checkedbox getfacing" value="North">
                                        North</label>
                                        <label for="check-123" ><input id="check-123" type="radio" name="facing[]" class="radiobox checkedbox getfacing" value="South">
                                        South</label>
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>
                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Floor" data-close-title="Floor"></a>
                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-129" type="checkbox" name="floors[]" class="checkedbox floors" value="1">
                                        <label for="check-129">1st Floor</label>
                                        <input id="check-130" type="checkbox" name="floors[]" class="checkedbox floors" value="2">
                                        <label for="check-130">2nd Floor</label>
                                        <input id="check-131" type="checkbox" name="floors[]" class="checkedbox floors" value="3">
                                        <label for="check-131">3rd Floor</label>
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>
                                       <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Role" data-close-title="Role"></a>
                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="radios one-in-row margin-bottom-10">
                                        <?php 
                                            if(count($otype)) {
                                                foreach ($otype as $key => $value) {
                                                 ?>
                                                  <label for="check-<?= $value->id; ?>"><input id="check-<?= $value->id; ?>" type="radio" name="role[]" class="radiobox checkedbox role" value="<?= $value->id; ?>">
                                       <?= $value->name; ?></label>
                                                 <?php
                                                }
                                            }
                                        ?> 
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>

                                       <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Available From" data-close-title="Available From"></a>
                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="radios one-in-row margin-bottom-10">
                                        <label for="check-500"><input id="check-500" type="radio" name="availablefrom[]" class="radiobox checkedbox availablefrom" value="Immediate">
                                       Immediate</label>
                                       <label for="check-502"><input id="check-502" type="radio" name="availablefrom[]" class="radiobox checkedbox availablefrom" value="Within 1 Month">
                                       Within 1 Month</label>
                                       <label for="check-503"><input id="check-503" type="radio" name="availablefrom[]" class="radiobox checkedbox availablefrom" value="After One Month">
                                       After One Month</label>
                                       <label for="check-504"><input id="check-504" type="radio" name="availablefrom[]" class="radiobox checkedbox availablefrom" value="Within 3 Month">
                                       Within 3 Month</label>
                                        <label for="check-501"><input id="check-501" type="radio" name="availablefrom[]" class="radiobox checkedbox availablefrom" value="After Three Month">
                                       After Three Month</label>

                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>


                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Parking" data-close-title="Parking"></a>
                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="radios one-in-row margin-bottom-10">
                                         <label for="check-127"><input id="check-127" type="radio" name="carpark[]" class="radiobox checkedbox carpark" value="Available">
                                       Yes</label>
                                        <label for="check-128"><input id="check-128" type="radio" name="carpark[]" class="radiobox checkedbox carpark" value="Un Available">
                                        No</label>
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>

                              

                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Furnish" data-close-title="Furnish"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="radios one-in-row margin-bottom-10">
                                        <label for="check-132"><input id="check-132" type="radio" name="furnish[]" class="radiobox checkedbox furnished" value="Furnished">
                                        Furnished</label>
                                        <label for="check-134"><input id="check-134" type="radio" name="furnish[]" class="radiobox checkedbox furnished" value="Semi Furnished">
                                        Semi- Furnished</label>
                                        <label for="check-133"><input id="check-133" type="radio" name="furnish[]" class="radiobox checkedbox furnished" value="Un Furnished">
                                        Non - Furnished</label>
                                   <!--      <input id="check-4" type="checkbox" name="check">
                                        <label for="check-4">Central Heating</label> -->
                                      <!--   <input id="check-5" type="checkbox" name="check">
                                        <label for="check-5">Semi Furnished</label> -->
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>
                                <!-- More Search Options / End -->
                                
                            </div>
                            
                           
                        </div>
                    </aside>

                    <div class="col-lg-9 col-md-12 blog-pots" id="property">
                        <section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <div class="text-heading text-left">
                                            <p class="font-weight-bold mb-0 mt-3"><?= count($countproperty);?> Search results</p>
                                        </div>
                                    </div>
                                </div>
                             
                            </div>
                        </section>
                        <div class="row" >
                            <?php
                                if(count($property)) {
                                    foreach ($property as $key => $feature) {
                                        $id = $feature->id;
                                        $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img','id desc','','',1);
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
                                        ?>                  <div class="item col-xl-4 col-lg-4 col-md-4 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-right">
 <div class="project-inner project-head"></div>
                             <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                <a href="<?= base_url().$feature->slug;?>" >
                                <div class="homes">
                                    <!-- homes img -->
                                   
                                   <div  class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <?php  if(is_array($getImg) && count($getImg)) {
                                            ?>
                                             <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                        <?php
                                          
                                        }
                                       ?>
                                    </div>
                              
                               
                           

                                 
                                </div>
                                <div class="button-effect">
                                 
                                  
                                </div>
                          

                                <?php
                            }
                            else {
                                ?>
<a href="<?= base_url().'propertydetails/'.$feature->slug;?>">
                                <div class="homes">
                                    <!-- homes img -->
                                   
                              
                              
                                   <div  class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <?php  if(is_array($getImg) && count($getImg)) {
                                            ?>
                                             <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                        <?php
                                          
                                        }
                                       ?>
                                    </div>
                           

                                 
                                </div>
                               
                            </a>
                                <?php
                            }
                        ?>

                            
                       
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                  <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                <h3><a href="<?= base_url().$feature->slug;?>"><?= $feature->title;?></a></h3>
                                <?php
                            }else 
                            {
                                ?>
<h3><a href="<?= base_url().'propertydetails/'.$feature->slug;?>"><?= $feature->title;?></a></h3>
                                <?php
                            }
                            ?>
                                
                                <p class="homes-address mb-3">
                                     <a href="#">
                                        <i class="fa fa-map-marker"></i>
                                            <?php
                                        if(!empty($feature->paddress)) {
                                            ?>
                                              <span><?= substr($feature->paddress,0,30).'...';?></span>
                                
                                            <?php 
                                        }
                                    ?>
                                        </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix pb-3">
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
                                             <a href="#"><i class="fa fa-rupee-sign"></i> <?=  number_format($feature->price);?></a>
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
                                           <a data-toggle="collapse" href="#collapseExample<?= $feature->id?>" role="button" aria-expanded="false" aria-controls="collapseExample" class="share" title="Share"><i class="flaticon-share"></i></a>

                                <div class="collapse share-a" id="collapseExample<?= $feature->id?>" style="bottom:50px">
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
                 
                           
                             <nav aria-label="..." class="pt-1 text-center">
                        <?php echo $links; ?>
                        </nav>
                            
                        </div>

                       
                    </div>
                    
                </div>
                
            </div>
        </section>

 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
<?= $footer;?>
<script type="text/javascript">
  


    function filter_data()
    {
    
        var price = get_filter('getamenity');
        var bhk = get_filter('getbhk');
        var facing = get_filter('getfacing');
        var carpark = get_filter('carpark');
        var furnished = get_filter('furnished');
        var floors = get_filter('floors');
        var role = get_filter('role');
        var availablefrom = get_filter('availablefrom');
        var id = "<?= $_GET['id'];?>";       
        var pid = "<?= $_GET['pid'];?>";       
        $.ajax({
            url:"<?= base_url();?>home/getFilters",
            method:"POST",
             dataType :"json",
            data:{price:price,bhk:bhk,id:id,pid:pid,facing:facing,role:role,availablefrom:availablefrom,furnish:furnished,floors:floors,carpark:carpark, "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},
            success:function(data){
                $("#property").html(data.msg);
                 $(".csrf_token").val(data.csrf_token);
            }
        });
    }
//filter_data();
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
   
 $('.checkedbox').click(function(){
       filter_data();    
   });


</script>