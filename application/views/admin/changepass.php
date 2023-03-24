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
                                <form method="post" action="<?= base_url().'property/passsave';?>">
                                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                                    <input type="hidden" name="uid" value="<?= $uid;?>">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="text" name="cpass" placeholder="Enter Current Password" required>
                                    </div>
                                     <div class="form-group">
                                        <label>New Password</label>
                                        <input type="text" name="npass" placeholder="Enter New Password" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                      
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>



