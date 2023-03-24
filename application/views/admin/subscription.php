<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    
                        <div class="my-properties">
                          <h3>Your Subscriptions</h3>
                            <?php
                                if($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                }
                            ?>
                              <a href="<?= base_url().'property/addpackages';?>" class="btn btn-primary" style="float:right;margin-bottom: 20px" readonly>Add Packages</a>
                             <br /><br /><br />
                            <table class="table-responsive" id="category_table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th class="pl-2">Title</th>
                                        <th class="p-0">Price</th>
                                        <th>Validity</th>
                                        <th>No of Days Left</th>
                                        <th>Package Offer <br />No of Properties</th>
                                        <th>Package Expiry Date</th>
                                        <th>Renew</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            if(count($getSubscription)) {
                                                $i =1;
                                                foreach ($getSubscription as $key => $value) {
                                                  $pid = $value->pid;
                                                  $getPropertycount = $this->master_db->getRecords('properties',['pid'=>$pid,'uid'=>$uid],'*');
                                                  $getownercount = $this->master_db->getRecords('owner_address',['pid'=>$pid,'uid'=>$uid],'*');
                                                  //echo $this->db->last_query();
                                                    $date1 = date_create($value->expire_date);
                                                    $date2 = date_create($value->created_at);
                                                    $date3 = date_create(date('Y-m-d'));
                                                    $datediff = date_diff($date1,$date2);
                                                    $datediff1 = date_diff($date1,$date3);
                                                    $validdays = $datediff1->format('%a Days');
                                                    $validity = $datediff->format('%a Days');
                                                    $packageexpire = date('d-m-Y',strtotime($value->expire_date));

                                                   ?>
                                                   <tr>
                                                       <td><?= $i++;?></td>
                                                       <td><?= $value->title;?></td>
                                                       <td><i class="fa fa-rupee-sign"></i> <?= number_format($value->price);?></td>
                                                       <td><?= $validity;?></td>
                                                       <td><?= $validdays;?></td>
                                                       <td><?= $value->properties;?></td>
                                                       
                                                       <td><?= $packageexpire;?></td>

                                                       <td><a href="<?= base_url().'property/addpackages';?>" title="Renew Now">Renew Now</a></td>
                                                   </tr>
                                                   <?php
                                                }
                                            }
                                        ?>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>


