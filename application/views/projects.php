<?php //echo count($propertyPackcount);exit; 
        
?>
<?= $header1;?>
<style type="text/css">
    .homes-content .homes-list {
    padding: 0px;
    margin: 0px;
}
 .homes-content .homes-list li {
    width: 33%;
    float: left;
    font-size: 14px;
    line-height: 36px;
    list-style: none;
    color: #0098ef;
}
 .homes-content.details span {
    font-size: 1rem;
    color: #000;
}
.homes-content .font-weight-bold.mr-1 {
    font-weight: 600;
    color: #555 !important;
}
.homes-content.details span {
    font-size: 1rem;
    color: #666;
}
iframe {
    width:100%!important;
}
.inner-pages .blog .blog-info.details, .listing-details-sliders.mb-30, .homes-content.details.mb-30, .property-location, .reviews.comments, .reviews.leve-comments, .wprt-image-video.w50.pro, .ag-de .similar-property, .ag-de .portfolio.py-0.age, .det .similar-property {
    padding: 1.5rem !important;
    background: #fff;
    border: 1px solid #eaeff5;
    -webkit-box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
    box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
}
.commented .comm-inf {
    display: -webkit-box;
    display: -ms-flexbox;
    /* display: flex; */
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-flex: 0;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
}
 .commented img {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    margin-right: 2rem;
}
.star-wrapper {
    direction: rtl;
    display: inline-block;
    font-size: 6px;
}
.star-wrapper a {
    font-size: 4em;
    color: #ababab;
    text-decoration: none;
    transition: all .5s;
    margin: 4px;
    cursor: pointer;
}
</style>
        <section class="breadcrumb-outer">
            <div class="container ">
                <div class="detail-title">
                    <div class="detail-title-inner">
                        <div class="row">
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="listing-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                </div>
                                <h2 class="white"><span><?php if(!empty($property[0]->title)) { echo $property[0]->title;} ?></span></h2>
                               
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="list-single-details text-right">
                                    <div class="list-single-rating w-100">
                                        <div class="rating-score d-flex align-items-center float-right">
                                            <div class="pr-3 white"><strong>Very Good</strong>
                                                <br><?php echo count($reviews);?> Reviews </div>
<!--                                             <span>4.5</span>
 -->                                        </div>
                                    </div>
                                    <div class="list-single-links w-100 mt-1">
                                        <a class="nir-btn nir-btn1 mr-3" href="#">For <?php 
                                            if(!empty($packagetype)) {
                                                if($packagetype[0]->type ==1) {
                                                    echo 'Rent';
                                                }
                                                if($packagetype[0]->type ==2) {
                                                    echo 'Sale';
                                                }
                                            }
                                        ?></a>
                                        <a class="nir-btn-black nir-btn1" href="#"> <?php if(!empty($property[0]->area)) { echo $property[0]->area." /Sq Ft";} ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <form action="<?= base_url().'home/search';?>" method="post">
                             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                            <div class="tab-pane fade show active" id="tabs_1">
                                                <div class="rld-main-search">
                                                    <div class="row">
                                                        <div class="rld-single-input  col-md-3  pl-1 pr-1">
                                                            <input type="text" placeholder="Enter Location or Keyword" name="location" id="location">
                                                        </div>

                                                         <div class="rld-single-input col-md-3  pl-1 pr-1">
                                                            <input type="text" placeholder="Enter Specific Area" name="area" id="area">
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
                                                            <button type="submit"  class="btn btn-yellow ml-0" > <i class="fa fa-search"></i> </button >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>

        <!-- START SECTION PROPERTIES LISTING -->
        <section class="single-proper blog details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 blog-pots">
                        <div class="row">
                            <div class="col-md-12">
                                <section class="headings-2 p-0">
                                </section>
                                <!-- main slider carousel items -->
                                <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                    <h5 class="mb-4">Gallery</h5>
                                    <a href="javascript:void(0)" id="favourites" title="Favorites" data-id="<?= sqftEncrypt($property[0]->id);?>" style="position: relative;float: right;right:10px;top:-50px">
                                            <i class="flaticon-heart" id="wish<?= sqftEncrypt($property[0]->id);?>"></i>
                                        </a>
                                    <div class="carousel-inner">

                                        <?php
                                          $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$property[0]->id],'id,p_img');
                                            if(count($getImg)) {
                                                $count =0;
                                                foreach ($getImg as $key => $value) {
                                                   

                                                     ?>
                                                          <div class="<?php if($count==0) {echo 'active';}else { echo '';} ?> item carousel-item" data-slide-number="<?php echo $value->id; ?>">
                                            <img src="<?= base_url().$value->p_img;?>" class="img-fluid" alt="slider-listing">
                                        </div> 
                                                     <?php
                                                     $count = $count + 1;
                                                }   
                                            }
                                        ?>
                                      
                                     

                                        <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                        <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>

                                    </div>
                                    <!-- main slider carousel nav controls -->
                                    <ul class="carousel-indicators smail-listing list-inline" style="width:95%!important">
                                         <?php
                                          $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$property[0]->id],'id,p_img');
                                            if(count($getImg)) {
                                                $count =0;
                                                foreach ($getImg as $key => $get) {
                                                     ?>
                                                      <li class="list-inline-item <?php if($count==0) {echo 'active';}else { echo '';} ?>">
                                            <a id="carousel-selector-0" class="selected" data-slide-to="<?php echo $get->id; ?>" data-target="#listingDetailsSlider">
                                                <img src="<?= base_url().$get->p_img;?>" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                                     <?php
                                                     $count = $count + 1;
                                                 }

                                             }
                                             ?>

                                       
                                 
                                    </ul>
                                    <!-- main slider carousel items -->
                                </div>
                                <div class="single homes-content details mb-30">
                                    <h5 class="mb-4">Description</h5>

                                    <?php
                                        if(!empty($property[0]->prodesc)) {
                                         echo $property[0]->prodesc;
                                        }
                                    ?>
                                    
                                  
                                </div>
                            </div>
                        </div>
                        <div class="single homes-content details mb-30">
                            <!-- title -->
                            <h5 class="mb-4">Property Details</h5>
  <ul class="homes-list clearfix">
                                <li>
                                    <span class="font-weight-bold mr-1">Property ID:</span>
                                    <span class="det"><?php
                                        if(!empty($property[0]->orderid)) {
                                         echo $property[0]->orderid;
                                        }
                                    ?></span>
                                </li>
                                <li>
                                    <span class="font-weight-bold mr-1">Property Type:</span>
                                    <span class="det"><?php
                                        if(!empty($property[0]->ptype)) {

                                            if($property[0]->ptype ==1) {
                                                echo 'Apartment';
                                            }
                                             else if($property[0]->ptype ==2) {
                                                echo 'House';
                                            }
                                             else if($property[0]->ptype ==3) {
                                                echo 'Office Space';
                                            }
                                             else if($property[0]->ptype ==4) {
                                                echo 'Commercial ';
                                            }
                                             else if($property[0]->ptype ==5) {
                                                echo 'Plot & Land';
                                            }
                                             else if($property[0]->ptype ==6) {
                                                echo 'Shop';
                                            }

                                             else if($property[0]->ptype ==7) {
                                                echo 'Building';
                                            }

                                     
                                        }
                                    ?></span>
                                </li>
                                <li>
                                    <span class="font-weight-bold mr-1">Property status:</span>
                                    <span class="det">For <?php 
                                        if(!empty($packagetype)) {
                                            if($packagetype[0]->type ==1) {
                                                echo 'Rent';
                                            }else if($packagetype[0]->type ==2) {
                                                echo "Sale";
                                            }
                                        }
                                    ?></span>
                                </li>
                                <?php if($property[0]->ownerrole =='2') {
                                    ?>
                                 <li>
                                    <span class="font-weight-bold mr-1">Commission Period:</span>
                                    <span class="det"><?php

                                      
                                        if($property[0]->cperiod !="0") {

                                            if($property[0]->cperiod ==1) {
                                                echo '15 Days';
                                            }
                                             else if($property[0]->cperiod ==2) {
                                                echo '1 Month';
                                            }
                                             else if($property[0]->cperiod ==3) {
                                                echo 'No Commission';
                                            }
                                            else if($property[0]->cperiod ==4) {
                                                echo 'Immediate';
                                            }
                                            

                                     
                                        }
                                 
                                    ?></span>
                                  </li>
                                  <?php
                            } ?>

                            <?php

                                    if($property[0]->ptype ==1) {

                                        ?>
                                           <li>
                                    <span class="font-weight-bold mr-1">Apartment Type:</span>
                                    <span class="det"><?php

                                        if( $property[0]->atype !="0") {

                                            if($property[0]->atype ==1) {
                                                echo 'Stand Alone Building';
                                            }
                                             else if($property[0]->atype ==2) {
                                                echo 'Mid Society';
                                            }
                                             else if($property[0]->atype ==3) {
                                                echo 'Gated Society';
                                            }
                                             else if($property[0]->atype ==4) {
                                                echo 'Branded Society ';
                                            }

                                        }
                                   
                                        
                                    ?></span>
                                </li>
                                <?php
                            }
                            ?>
                            <?php if(!empty($property[0]->price) && $property[0]->price !="0") {
                                ?>
                                <li>
                                    <span class="font-weight-bold mr-1">Property Price:</span>
                                    <span class="det"><i class="fas fa-rupee-sign"></i> <?php if(!empty($property[0]->price)) { echo number_format($property[0]->price);}?> /-</span>
                                </li>
                                <?php
                            } 

                            ?>
                                <?php
                                    if(count($area) >0) {
                                        ?>
                                        <li>
                                    <span class="font-weight-bold mr-1">Area:</span>
                                    <span class="det"><?php if(!empty($area[0]->areaname)) { echo $area[0]->areaname; }?> </span>
                                </li>
                                        <?php
                                    }
                                ?>
                                   <?php
                                    if(!empty($property[0]->bedrooms)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Bedrooms:</span>
                                    <span class="det"><?php echo $property[0]->bedrooms;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->bathrooms)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Bathrooms:</span>
                                    <span class="det"><?php echo $property[0]->bathrooms;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->balcony)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Balcony:</span>
                                    <span class="det"><?php echo $property[0]->balcony;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                    <?php
                                    if(!empty($property[0]->availability)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Aailability:</span>
                                    <span class="det"><?php echo $property[0]->availability;?></span>
                                </li>
                                        <?php
                                    }
                                ?>
                               

                                 <?php
                                    if(!empty($property[0]->furnished)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Furnished:</span>
                                    <span class="det"><?php echo $property[0]->furnished;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                  <?php
                                    if(!empty($property[0]->wateravail)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Water Availability:</span>
                                    <span class="det"><?php echo $property[0]->wateravail;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                   <?php
                                    if(!empty($property[0]->carpark)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Carparking:</span>
                                    <span class="det"><?php echo $property[0]->carpark;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->washrrom)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Washroom:</span>
                                    <span class="det"><?php echo $property[0]->washroom;?></span>
                                </li>
                                        <?php
                                    }
                                ?>


                                 <?php
                                    if(!empty($property[0]->overlooking)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Overlooking:</span>
                                    <span class="det"><?php echo $property[0]->overlooking;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->electricity)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Electricity:</span>
                                    <span class="det"><?php echo $property[0]->electricity;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->washroom)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Washroom:</span>
                                    <span class="det"><?php echo $property[0]->washroom;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                <?php
                                    if(!empty($property[0]->face)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Facing:</span>
                                    <span class="det"><?php echo $property[0]->face;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->lockperiod)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Lockperiod:</span>
                                    <span class="det"><?php echo $property[0]->lockperiod;?></span>
                                </li>
                                        <?php
                                    }
                                ?>


                                 <?php
                                    if(!empty($property[0]->plotarea)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Plotarea:</span>
                                    <span class="det"><?php echo $property[0]->plotarea;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->unitoffloor)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Unit to Floor:</span>
                                    <span class="det"><?php echo $property[0]->unitoffloor;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->seats)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Seats:</span>
                                    <span class="det"><?php echo $property[0]->seats;?></span>
                                </li>
                                        <?php
                                    }
                                ?>

                                 <?php
                                    if(!empty($property[0]->pantry)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Pantry:</span>
                                    <span class="det"><?php echo $property[0]->pantry;?></span>
                                </li>
                                        <?php
                                    }
                                ?>


                                 <?php
                                    if(!empty($property[0]->maintenancecharge)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Maintenanace Charge:</span>
                                    <span class="det"><?php echo $property[0]->maintenancecharge;?></span>
                                </li>
                                        <?php
                                    }
                                ?>



                                 <?php
                                    if(!empty($property[0]->ttype)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">Transaction Type:</span>
                                    <span class="det"><?php echo $property[0]->ttype;?></span>
                                </li>
                                        <?php
                                    }
                                ?>


                                  <?php
                                    if(!empty($property[0]->leedcertificate)) {
                                        ?>
                                         <li>
                                    <span class="font-weight-bold mr-1">LEED Certificate:</span>
                                    <span class="det"><?php echo $property[0]->leedcertificate;?></span>
                                </li>
                                        <?php
                                    }
                                ?>
                               
                            </ul>
                            <!-- title -->
                            <h5 class="mt-5">Amenities</h5>
                            <?php
                                $getamenities = $this->master_db->sqlExecute('select pa.p_amenities,a.title from property_amenities pa left join amenities a on a.id = pa.p_amenities where pa.prid='.$property[0]->id.' group by p_amenities');
                                

                            ?>
                            <ul class="homes-list clearfix">
                             <?php
                                   if(count($getamenities) >0) {
                                        foreach ($getamenities as $key => $value) {
                                            ?>
                                             <li>
                                    <i class="fa fa-check-square" aria-hidden="true"></i>
                                    <span><?= $value->title;?></span>
                                </li>
                                            <?php
                                        }
                                    }
                             ?>
                               
                           
                            </ul>
                        </div>
                      
                        <div class="floor-plan property wprt-image-video w50 pro">
                            <h5>What's Nearby</h5>
                            <div class="property-nearby">
                                <div class="row">
                                    <div class="col-lg-12">
                                            <?php
                                    if(!empty($property[0]->nearbyarea)) {
                                        echo $property[0]->nearbyarea;
                                    }

                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                      
                        <!-- Star Reviews -->
                        <section class="reviews comments">
                            <h3 class="mb-5"><?php echo count($reviews); ?> Reviews</h3>
                            <div class="row mb-5">
                                <?php
                                    if(count($reviews)) {
                                        foreach ($reviews as $key => $value) {
                                            ?>
                                                 <ul class="col-12 commented pl-0">
                                    <li class="comm-inf">
                                        <div class="col-md-2">
                                            <img src="<?= asset_url();?>images/testimonials/ts-5.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-10 comments-info">
                                            <div class="conra">
                                                <h5 class="mb-2"><?= $value->name;?></h5>
                                                <?php 
                                                    if($value->rating ==1) {
                                                      ?>
                                                          <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                       
                                                    </div>
                                                </div>
                                                        <?php
                                                    }

                                                     else  if($value->rating ==2) {
                                                      ?>
                                                          <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                       
                                                    </div>
                                                </div>
                                                        <?php
                                                    }


                                                      else if($value->rating ==3) {
                                                      ?>
                                                          <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                     
                                                    </div>
                                                </div>
                                                        <?php
                                                    }

                                                      else if($value->rating ==4) {
                                                      ?>
                                                          <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                       
                                                    </div>
                                                </div>
                                                        <?php
                                                    }

                                                     else  if($value->rating ==5) {
                                                      ?>
                                                          <div class="rating-box">
                                                    <div class="detail-list-rating mr-0">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                        <?php
                                                    }

                                                ?>
                                              
                                            </div>
                                            <p class="mb-4"><?php echo date('M d Y',strtotime($value->created_at)); ?></p>
                                            <p><?= $value->reviews;?></p>
                                        </div>
                                    </li>

                                </ul>  
                                            <?php
                                        }
                                    }
                                ?>
                               
                            </div>
                           
                        </section>
                        <!-- End Reviews -->
                        <!-- Star Add Review -->
                        <section class="single reviews leve-comments details">
                            <div id="add-review" class="add-review-box">
                                <!-- Add Review -->
                                <h3 class="listing-desc-headline margin-bottom-20 mb-4">Add Review</h3>
                          
                                <div class="row">
                                    <div class="col-md-12 data">
                                         <div id="reviewmsgbox"></div>
                                        <form method="post" >
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                                  <span class="leave-rating-title">Your rating for this listing</span>
                                <!-- Rating / Upload Button -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <!-- Leave Rating -->
                                        <div class="clearfix"></div>
                                        <div class="leave-rating margin-bottom-30">
                                            <label for="">Rate here</label> <br>
                                                    <div class="star-wrapper">
                                                        <a class="fas fa-star  s5" rel="5" id="rating"></a>
                                                        <a class="fas fa-star s4" rel="4" id="rating"></a>
                                                        <a class="fas fa-star s3" rel="3" id="rating"></a>
                                                        <a class="fas fa-star s2" rel="2" id="rating"></a>
                                                        <a class="fas fa-star s1" rel="1" id="rating"></a>
                                                    </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="ratereview"></div>
                                                <input type="hidden" name="ratings" id="ratings" value="4">
                                </div>
                                       
                                            <div class="col-md-12 form-group" style="margin-top: 30px">
                                                <textarea class="form-control" id="review"  name="review" rows="8" placeholder="Review" required></textarea>
                                            </div>
                                            <button type="submit"  id="submit" class="btn btn-primary btn-lg mt-2">Submit Review</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Add Review -->
                    </div>
                    <aside class="col-lg-4 col-md-12 car">
                        <div class="single widget sticky-top inner-pages">
                            <!-- Start: Schedule a Tour -->
                            
                            <!-- End: Schedule a Tour -->
                            <!-- end author-verified-badge -->
                            <div class="sidebar">

                                
                            
                                <div class="main-search-field-2">
                                    <p style="color:red">Please Sign in to View Contact Details</p>
                                    <a href="<?= base_url().'login';?>" class="nir-btn nir-btn1 mr-3">Sign in</a>
                                    <div class="widget-boxed mt-5">
                                        <div class="widget-boxed-header">
                                            <h4>Recent Properties</h4>
                                        </div>
                                        <div class="widget-boxed-body">
                                            <div class="recent-post">
                                                <?php if(count($recentProperty) >0) {
                                                       foreach ($recentProperty as $key => $recent) {
                                                        $id = $recent->id;

                                                        $getRecentimg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img','id desc','','','1');
                                                          ?>
                                            


                                                <div class="recent-main mb-3">
                                                    <div class="recent-img">
                                                          <?php
                                                            if(is_array($getRecentimg) && count($getRecentimg) >0) {
                                                                if(!$this->session->userdata(ADMIN_SESSION)) {
                                                                ?>

                                                                 <a href="<?= base_url().$recent->slug;?>"><img src="<?= base_url().$getRecentimg[0]->p_img; ?>" alt=""></a>
                                                                <?php
                                                            }else {
                                                                ?>
                                                                     <a href="<?= base_url().'propertydetails/'.$recent->slug;?>"><img src="<?= base_url().$getRecentimg[0]->p_img; ?>" alt=""></a>
                                                                <?php
                                                            }
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="info-img">
                                                        <a href="<?= base_url().$recent->slug;?>"><h6><?= $recent->title?></h6></a>

                                                        <?php
                                                        if(!empty($recent->area) && $recent->area !="0") {
                                                            ?>
                                                              <p><i class="fas fa-rupee-sign"></i> <?php echo $recent->area; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                          <?php
                                                       }
                                                }   
                                                ?>
                                               


                                              
                                            </div>


<!--   <div class="recent-post">
                                                <div class="recent-main">
                                                    <div class="recent-img">
                                                        <a href="blog-details.html"><img src="images/feature-properties/fp-1.jpg" alt=""></a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a href="blog-details.html"><h6>Family Home</h6></a>
                                                        <p>$230,000</p>
                                                    </div>
                                                </div>
                                                
                                            </div> -->


                                        </div>
                                    </div>
                                    
                                    <!-- Start: Specials offer -->
                                    
                                    <!-- End: Specials offer -->
                                    
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- START SIMILAR PROPERTIES -->
                <section class="similar-property featured portfolio p-0 mt-5 bg-white-inner">
                    <div class="container">
                        <h5>Similar Properties</h5>
                        <div class="row portfolio-items">
                            <?php
                                if(count($similar) >0) {
                                    foreach ($similar as $key => $sim) {
                                        $pid = $sim->pid;
                                        $id = $sim->id;
                                        $getType = $this->master_db->getRecords('packages',['id'=>$pid],'type');
                                        $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$id],'p_img','id asc','','','1');

                                        ?>
                                              <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">

                                                     <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                             <a href="<?= base_url().$sim->slug;?>" class="project-inner project-head">

                                <?php
                            }else {
                                ?>
                                <a href="<?= base_url().'propertydetails/'.$sim->slug;?>" class="project-inner project-head">
                                <?php
                            }
                          
                          ?>
                                    
                                        <div class="homes">
                                               <div  class="homes-img">
                                                <div class="homes-tag button alt sale">For <?php 
                                                if(!empty($getType)) { 
                                                    if($getType[0]->type ==1) 
                                                        {
                                                            echo 'Rent';
                                                } 
                                                else if($getType[0]->type ==2) {echo 'Sale';}} ?></div>
                                             
                                               
                                                <?php if(!empty($getImg)) {
                                                    ?>
                                                         <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                                    <?php
                                                }?>
                                               
                                            </div>
                                            <!-- homes img -->
                             

                                            
                                        </div>
                                       
                                    </a>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3>                   <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                    ?>
<a href="<?= base_url().$sim->slug;?>"><?= ucfirst($sim->title);?></a>
                                    <?php
                            }else {
                                ?>
<a href="<?= base_url().'propertydetails/'.$sim->slug;?>"><?= ucfirst($sim->title);?></a>
                                <?php
                            }
                                ?></h3>
                                       
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                         

                                                                 <li>
                                    <span class="font-weight-bold mr-1"> Type:</span>
                                    <span class="det"><?php
                                        if(!empty($sim->ptype)) {

                                            if($sim->ptype ==1) {
                                                echo 'Apartment';
                                            }
                                             else if($sim->ptype ==2) {
                                                echo 'House';
                                            }
                                             else if($sim->ptype ==3) {
                                                echo 'Office Space';
                                            }
                                             else if($sim->ptype ==4) {
                                                echo 'Commercial ';
                                            }
                                             else if($sim->ptype ==5) {
                                                echo 'Plot & Land';
                                            }
                                             else if($sim->ptype ==6) {
                                                echo 'Shop';
                                            }

                                             else if($sim->ptype ==7) {
                                                echo 'Building';
                                            }

                                     
                                        }
                                    ?></span>
                                </li>
                             <li>
                                    <span class="font-weight-bold mr-1">Facing:</span>
                                    <span class="det"><?php
                                        if(!empty($sim->face)) {
                                         echo $sim->face;
                                        }
                                    ?></span>
                                </li>
                        
                                           
                                        </ul>

                                         <div class="price-properties footer pt-3 pb-0">
                                    <h3 class="title mt-3">
                                      <?php if(!empty($sim->price)) {
                                            ?>
                                               <a href="#"><i class="fa fa-rupee-sign"></i> <?php if(!empty($sim->price)) {

                                      echo  number_format($sim->price); 
                                     } ?></a>
                                            <?php
                                        }
                                        ?>
                                    </h3>
                                    <div class="compare">
                                              <?php
                                        if(!empty($sim->videotype) && $sim->videotype !="") {
                                            if($sim->videotype ==1) {
                                                ?>
                                               <a href="<?= base_url().$sim->video_path?>" class="btn popup-video popup-youtube" style="display: inline-block;
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
                                            else if($sim->videotype ==2) {
                                                ?>
                                                <a href="https://www.youtube.com/watch?v=<?= $sim->video_path;?>" class="btn popup-video popup-youtube" style="display: inline-block;
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
                                          <a data-toggle="collapse" href="#collapseExample<?= $sim->id?>" role="button" aria-expanded="false" aria-controls="collapseExample" class="share" title="Share"><i class="flaticon-share"></i></a>

                                <div class="collapse share-a" id="collapseExample<?= $sim->id?>" style="bottom:50px">
                                    <div class=" p-0">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url().$sim->slug;?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                        <a href="http://twitter.com/share?text=?&url=<?= base_url().$sim->slug;?>&hashtags=#gogarbha"  target="_blank"class="twitter"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                                             <a href="javascript:void(0)" id="favourites" title="Favorites" data-id="<?= sqftEncrypt($sim->id);?>" >
                                            <i class="flaticon-heart" id="wish<?= sqftEncrypt($sim->id);?>"></i>
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
                <!-- END SIMILAR PROPERTIES -->
            </div>
        </section>
        <!-- END SECTION PROPERTIES LISTING -->
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
<?= $footer;?>
 
<script type="text/javascript">
  
$(document).ready(function() {
     $('.star-wrapper a').on('click', function(event) {
event.preventDefault();
            $('.star-wrapper a').find('b').remove();

var rate = $(this).attr("rel");
$('#ratings').val(rate);
$(this).append("<b></b>");
           
        });

                $(".s1").on('click',function(e) {
                    e.preventDefault();
                     $(".fa-star").css("color", "#ababab");
                    $(".s1").css("color",'gold');
                });

                $(".s2").on('click',function(e) {
                    e.preventDefault();
                     $(".fa-star").css("color", "#ababab");
                    $(".s1, .s2").css("color",'gold');
                });

                $(".s3").on('click',function(e) {
                    e.preventDefault();
                     $(".fa-star").css("color", "#ababab");
                    $(".s1, .s2,.s3").css("color",'gold');
                });

                $(".s4").on('click',function(e) {
                    e.preventDefault();
                     $(".fa-star").css("color", "#ababab");
                    $(".s1, .s2,.s3,.s4").css("color",'gold');
                });

                $(".s5").on('click',function(e) {
                    e.preventDefault();
                     $(".fa-star").css("color", "#ababab");
                    $(".s1, .s2,.s3,.s4,.s5").css("color",'gold');
                });

                $("#st1").click(function() {
              $(".fa-star").css("color", "#ababab");
              $("#st1").css("color", "yellow");

          });
      
<?php
    $getUsers = $this->master_db->getRecords('users',['id'=>$property[0]->uid],'name');
?>

           $('body').on('click',"#submit", function(e) {
            e.preventDefault();
            var review_descp = $("#review").val();
            var ratings = $("#ratings").val();
            var uid = '<?= $property[0]->uid;?>';
            var uname = '<?= $getUsers[0]->name;?>';
            var prid = '<?= $property[0]->id;?>';
            $("#reviewmsgbox").show();
           if ($.trim(review_descp) == "") {
                $("#reviewmsgbox").html(
                    '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Enter Your Review.</div>'
                );
                return false;
            } else {
                $.ajax({
                    url: "<?= base_url() . 'home/reviews'; ?>",
                    method: "post",
                    dataType:"json",
                    data: {
                        reviews: review_descp,
                        ratings: ratings,
                        uid: uid,
                        prid :prid,
                        uname:uname,
                         "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                    },
                    success: function(data) {
                   
                        if(data.status ==true) {
                                  $("#reviewmsgbox").html('<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'+data.msg+'</div>');
                                  $(".csrf_token").val(data.csrf_token);
                        }else if(data.status ==false) {
                            $("#reviewmsgbox").html('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'+data.msg+'</div>');
                            $(".csrf_token").val(data.csrf_token);
                        }
                        else if(data.status ==-1) {
                            window.location.href="<?= base_url().'login';?>";
                        }

                    }
                });
            }
        });
});
          
  $(document).ready(function() {
                $(document).on("click",'#favourites',function(e) {

                   
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        url :"<?= base_url();?>home/wishlist",
                        method:"post",
                        data:{
                            id:id,
                             "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                        },
                        dataType:"json",
                        success:function(data) {
                            if(data.status ==true) {
                                $('#wish'+id).addClass('favourite');
                                $(".csrf_token").val(data.csrf_token);

                            }else if(data.status ==false) {
                                window.location.href="<?= base_url();?>login";
                                $(".csrf_token").val(data.csrf_token);
                            }
                        }
                    });
                });
            });

     
</script>