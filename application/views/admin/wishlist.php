<?php //echo "<pre>";print_r($wishlist);exit; ?>
<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                      <div class="my-properties">
                        <h3>Favourite Properties</h3>
                         <?php 
                                        if(count($wishlist) >0) {
                                            ?>
                            <table class="table-responsive">
                                <thead>
                                    <tr>
                                        <th class="pl-2">Top Property</th>
                                        <th class="p-0"></th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                            foreach ($wishlist as $key => $value) {
                                                $id = $value->id;
                                                $getImg = $this->master_db->sqlExecute('select p_img from property_gallery where prid='.$id.' order by id asc limit 1');
                                                ?>
                                                 <tr>
                                        <td class="image myelist">
                                             <?php if(is_array($getImg) && count($getImg) >0) { 

                                                ?>
                                             <a href="<?= base_url().'propertydetails/'.$value->slug;?>"><img alt="my-properties-3" src="<?= base_url().$getImg[0]->p_img;?>" alt="home-1" class="img-fluid"></a>
                                                <?php
                                             } ?>
                                            

                                        </td>
                                        <td>
                                            <div class="inner">
                                                <a href="<?= base_url().'propertydetails/'.$value->slug;?>"><h2 style="text-align: left!important"><?= $value->title;?></h2></a>
                                               
                                            </div>
                                        </td>
                                        <td><?php if(!empty($value->created_at)) {echo date('d-m-Y',strtotime($value->created_at)); };?></td>
                                        <td class="actions">
                                            
                                            <a href="<?= base_url().'property/deletewishlist/'.sqftEncrypt($value->wid);?>"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                                <?php
                                            }
                                   ?>
                                </tbody>
                            </table>
<?php
                          }else {
                            echo "<h3 style='text-align:center'>You are yet to add something here</h3>";
                          }
                                    ?>
                        </div>
                      
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>



