<section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <div class="text-heading text-left">
                                            <p class="font-weight-bold mb-0 mt-3"><?= count($property);?> Search results</p>
                                        </div>
                                    </div>
                                </div>
                             
                            </div>
                        </section>
                        <div class="clearfix"></div>
                         <div class="row" >
<?php

                                if(is_array($property) && count($property) >0) {
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
                                        ?>  
                                                        <div class="item col-xl-4 col-lg-4 col-md-4 col-xs-12 landscapes sale">
                        <div class="project-single">
                                          <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                 <a href="<?= base_url().$feature->slug;?>" class="project-inner project-head">
                                <?php

                            }
                            else {
                                ?>
 <a href="<?= base_url().'propertydetails/'.$feature->slug;?>" class="project-inner project-head">
                                <?php

                            }
                            ?>
                           
                                <div class="homes">
                                    <!-- homes img -->
                                             <?php
                            if(!$this->session->userdata(ADMIN_SESSION)) {
                                ?>
                                   <a href="<?= base_url().$feature->slug;?>" class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <?php  if(is_array($getImg) && count($getImg)) {
                                            ?>
                                             <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                        <?php
                                          
                                        }
                                       ?>
                                    </a>
                                <?php
                            }else {
                                ?>
                                   <a href="<?= base_url().'propertydetails/'.$feature->slug;?>" class="homes-img">
                                        <div class="homes-tag button alt sale">For <?= $type;?></div>
                                        <?php  if(is_array($getImg) && count($getImg)) {
                                            ?>
                                             <img src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-responsive">
                                        <?php
                                          
                                        }
                                       ?>
                                    </a>
                                <?php
                            }
                            ?>
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
                                        <?php
                                            if(!empty($feature->price)) {

                                                ?>
                                                <a href="#"><i class="fa fa-rupee-sign"></i> <?php echo number_format($feature->price);?></a>
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
                                }else {
                                    echo "<h3 style='text-align:center!important'>No listing found</h3>";
                                }
                            ?>
                        </div>
                 
                           
                          