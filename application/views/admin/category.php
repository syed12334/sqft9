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
                                            <div id="error"></div>
                                            <form action="<?= base_url().'home/search';?>" method="get">
                                            <div class="tab-pane fade show active" id="tabs_1">
                                                <div class="rld-main-search">
                                                    <div class="row">
                                                        <div class="rld-single-input">
                                                            <input type="text" placeholder="Enter Location or Keyword" name="location" id="location">
                                                        </div>
                                                        <div class="rld-single-select ml-22">
                                                            <select class="select single-select" name="pcat" id="pcat">
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
                                                        <div class="rld-single-select ml-22">
                                                            <select class="select single-select" name="ptype" id="ptype">
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
                                                        </div>
                                                    
                                                        
                                                       
                                                        
                                                            <button type="submit"  class="btn btn-yellow" id="submit" > <i class="fa fa-search"></i> </button >




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
                                
                                <!-- 
                                <div class="main-search-field-2">
                                    
                                    <div class="range-slider">
                                        <label>Area Size</label>
                                        <div id="area-range" data-min="0" data-max="1300" data-unit="sq ft"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    
                                    <div class="range-slider">
                                        <label>Price Range</label>
                                        <div id="price-range" data-min="0" data-max="600000" data-unit="$"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>Price Fields -->
                                
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
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-100" type="checkbox" name="getbhk[]" value="1" class="checkedbox getbhk">
                                        <label for="check-100">1 Bhk</label>
                                        <input id="check-101" type="checkbox" name="getbhk[]" value="2" class="checkedbox getbhk">
                                        <label for="check-101">2 Bhk</label>
                                        <input id="check-102" type="checkbox" name="getbhk[]" value="3" class="checkedbox getbhk">
                                        <label for="check-102">3 Bhk</label>
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>



                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Facing" data-close-title="Facing"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-120" type="checkbox" name="facing[]" class="checkedbox getfacing" value="East">
                                        <label for="check-120" >East</label>
                                        <input id="check-121" type="checkbox" name="facing[]" class="checkedbox getfacing" value="West">
                                        <label for="check-121" >West</label>
                                        <input id="check-122" type="checkbox" name="facing[]" class="checkedbox getfacing" value="North">
                                        <label for="check-122">North</label>
                                        <input id="check-123" type="checkbox" name="facing[]" class="checkedbox getfacing" value="South">
                                        <label for="check-123" >South</label>
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>



                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Floor" data-close-title="Floor"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-129" type="checkbox" name="floors[]" class="checkedbox floors" value="1st Floor">
                                        <label for="check-129">1st Floor</label>
                                        <input id="check-130" type="checkbox" name="floors[]" class="checkedbox floors" value="2nd Floor">
                                        <label for="check-130">2nd Floor</label>
                                        <input id="check-131" type="checkbox" name="floors[]" class="checkedbox floors" value="3rd Floor">
                                        <label for="check-131">3rd</label>
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>



                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Parking" data-close-title="Parking"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-127" type="checkbox" name="carpark[]" class="checkedbox carpark" value="Available">
                                        <label for="check-127">Yes</label>
                                        <input id="check-128" type="checkbox" name="carpark[]" class="checkedbox carpark" value="Un Available">
                                        <label for="check-128">No</label>
                                        
                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>




                                <a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Furnish" data-close-title="Furnish"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        <input id="check-132" type="checkbox" name="furnish[]" class="checkedbox furnished" value="Furnished">
                                        <label for="check-132">Furnished</label>
                                        <input id="check-133" type="checkbox" name="furnish[]" class="checkedbox furnished" value="Un Furnished">
                                        <label for="check-133">Non - Furnished</label>
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

                    <div class="col-lg-9 col-md-12 blog-pots">
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
                        <div class="row" id="property">
                            <?php
                                if(count($property)) {
                                    foreach ($property as $key => $feature) {
                                        $id = $feature->id;
                                        $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img','id desc','','',1);
                                          $pid = $feature->pid;
                                $getPackage = $this->master_db->getRecords('packages',['id'=>$pid],'type');
                                $type = "";
                                if($getPackage[0]->type ==1) {
                                    $type .="Rent";
                                }else if($getPackage[0]->type ==2) {
                                     $type .="Sale";
                                }
                                        ?>                  <div class="item col-xl-4 col-lg-4 col-md-4 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-right">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="<?= base_url().'home/propertyview/'.$feature->slug;?>" class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <?php  if(is_array($getImg) && count($getImg)) {
                                            ?>
                                             <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                        <?php
                                          
                                        }
                                       ?>
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="<?= base_url().'home/propertyview/'.$feature->slug;?>" class="btn"><i class="fa fa-link"></i></a>
                                    <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                    <a href="<?= base_url().'home/propertyview/'.$feature->slug;?>" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="#"><?= $feature->title;?></a></h3>
                                <p class="homes-address mb-3">
                                    <a href="#">
                                        <i class="fa fa-map-marker"></i><span><?= $feature->paddress;?></span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix pb-3">
                                    <li class="the-icons">
                                        <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                        <span><?= $feature->bedrooms;?> Bedrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                        <span><?= $feature->bathrooms;?> Bathrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                        <span><?= $feature->area;?> sq ft</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                        <span><?php if(!empty($feature->balcony)) {echo $feature->balcony;} ?></span>
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
                                        <a href="#" title="Compare">
                                            <i class="flaticon-compare"></i>
                                        </a>
                                        <a href="#" title="Share">
                                            <i class="flaticon-share"></i>
                                        </a>
                                       
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


<?= $footer;?>
<script type="text/javascript">
  


    function filter_data()
    {
    
        var amenities = get_filter('getamenity');
        var bhk = get_filter('getbhk');
        var facing = get_filter('getfacing');
        var carpark = get_filter('carpark');
        var furnished = get_filter('furnished');
        var floors = get_filter('floors');
        var id = "<?= @$_GET['id'];?>";       
        var pid = "<?= @$_GET['pid'];?>";       
        $.ajax({
            url:"<?= base_url();?>home/getFilters",
            method:"POST",
             dataType :"html",
            data:{amenities:amenities,bhk:bhk,id:id,pid:pid,facing:facing,furnish:furnished,floors:floors,carpark:carpark},
            success:function(data){
                $("#property").html(data);
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