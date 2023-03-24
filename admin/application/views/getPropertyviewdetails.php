<?php
   // echo "<pre>";print_r($amentites);exit;
?>
<style type="text/css">
    .single-proper {
        padding: 1.5rem !important;
    background: #fff;
    border: 1px solid #eaeff5;
    -webkit-box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
    box-shadow: 0 0 10px 1px rgb(71 85 95 / 8%);
    }
</style>
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
                                    <div class="carousel-inner">

                                        <?php
                                          $getImg = $this->master_db->getRecords('property_gallery',['prid'=>$property[0]->id],'id,p_img');
                                            if(count($getImg)) {
                                                $count =0;
                                                foreach ($getImg as $key => $value) {
                                                   

                                                     ?>
                                                          <div class="<?php if($count==0) {echo 'active';}else { echo '';} ?> item carousel-item" data-slide-number="<?php echo $value->id; ?>">
                                            <img src="<?= app_url().$value->p_img;?>" class="img-fluid" alt="slider-listing">
                                        </div> 
                                                     <?php
                                                     $count = $count + 1;
                                                }   
                                            }
                                        ?>
                                      
                                        <br />

                                        <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev" style="border:1px solid #ccc;padding: 15px"><i class="fa fa-angle-left"></i></a>
                                        <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next" style="border:1px solid #ccc;padding: 15px"><i class="fa fa-angle-right"></i></a>
                                        <br />  <br />
                                    </div>
                                      <br />  <br />
                                    <!-- main slider carousel nav controls -->
                                    <ul class="carousel-indicators smail-listing list-inline" >
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
                            <ul class="homes-list clearfix" style="line-height: 30px">
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

                                       if(is_array($atype) && count($atype)) {
                                        echo $atype[0]->name;
                                       }
                                   
                                        
                                    ?></span>
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

                                <li>
                                    <span class="font-weight-bold mr-1">Property Price:</span>
                                    <span class="det"><i class="fas fa-rupee-sign"></i> <?php if(!empty($property[0]->price)) { echo number_format($property[0]->price);}?> /-</span>
                                </li>
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
                            <ul class="homes-list clearfix" style="line-height: 30px">
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
                 
                      
                   
                 
                    </div>
                                       <aside class="col-lg-4 col-md-12 car">
                        <div class="single widget sticky-top">
                            <!-- Start: Schedule a Tour -->
                            
                            <!-- End: Schedule a Tour -->
                            <!-- end author-verified-badge -->
                            <div class="sidebar">

                              
                                                <div class="widget-boxed mt-33 mt-0">
                                    <div class="widget-boxed-header">
                                        <h4>Owner Information</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="sidebar-widget author-widget2">
                                            <div class="author-box clearfix">
                                                <img src="<?= app_asset_url();?>images/testimonials/ts-1.jpg" alt="author-image" class="author__img" style="width:40px!important;height: auto!important">
                                                <h4 class="author__title">
                                                    <?php 
                                                        if(!empty($property[0]->oname)) {
                                                            echo $property[0]->oname;
                                                        }
                                                    ?>
                                                </h4>
                                            </div>
                                            <ul class="author__contact" style="line-height: 30px">
                                                 <?php 
                                                        if(!empty($property[0]->oaddress)) {
                                                           ?>
                                                                            <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i> <?php echo $property[0]->oaddress;?></span></li>
                                                           <?php
                                                        }
                                                    ?>
                                  <?php 
                                                        if(!empty($property[0]->ophone)) {
                                                           ?>
                                                                            <li><span class="la la-phone" style="color:#000"><i class="fa fa-phone" aria-hidden="true" style="margin-right:10px"></i></span><a href="tel:<?php echo $property[0]->ophone;?>" style="color:#000"><?php echo $property[0]->ophone;?></a></li>
                                                           <?php
                                                        }
                                                    ?>
                                               

                                                   <?php 
                                                        if(!empty($property[0]->oemail)) {
                                                           ?>
                                                                            <li><a href="mailto:<?php echo $property[0]->oemail;?>" style="color:#000"><span class="la la-envelope-o"><i class="fa fa-envelope" style="margin-right:10px;color:#000"></i> <?php echo $property[0]->oemail;?></span></a></li>
                                                           <?php
                                                        }
                                                    ?>
                                               
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                                     
                              
          
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
</section>