<?php //echo "<pre>";print_r($getUsers);exit; ?>
<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                   <div class="widget-boxed-header">
                            <h4>Profile Details</h4>
                        </div>
                        <div class="sidebar-widget author-widget2">
                           
                            <div class="agent-contact-form-sidebar">
                                <?php
                                    if($this->session->flashdata('message')) {
                                        echo $this->session->flashdata('message');
                                    }
                                ?>
                                <form method="post" action="<?= base_url().'property/editsave';?>">
                                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                    <input type="hidden" name="uid" value="<?= $getUsers[0]->id;?>">
                                    <input type="text" id="fname" name="name" placeholder="Full Name"  value="<?= $getUsers[0]->name;?>"/>
                                    <input type="number" id="pnumber" name="phone" placeholder="Phone Number" value="<?= $getUsers[0]->phone;?>" />
                                    <input type="email" id="emailid" name="email" placeholder="Email Address" value="<?= $getUsers[0]->email;?>" />
                                    <textarea placeholder="Address" name="address" ><?= $getUsers[0]->address;?></textarea>
                                    <input type="submit" class="multiple-send-message" />
                                </form>
                            </div>
                        </div>
                      
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>



