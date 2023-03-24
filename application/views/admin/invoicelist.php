<?php //echo "<pre>";print_r($userpackage);exit; ?>
<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                        
                        <div class="my-properties">
<h2 style="margin-bottom: 30px;text-transform: capitalize;">Invoice list</h2>
                            <?php
                                if($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                }
                            ?>
                             
                            <table class="table-responsive" id="category_table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Order ID</th>
                                        <th>Payment ID</th>
                                        <th>Package Date</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($userpackage)) {
                                            $i=1;
                                            foreach ($userpackage as $users) {
                                                $uid = $users->user_id;
                                                $getpay = $this->master_db->getRecords('payment_log',['user_id'=>$uid],'*');
                                                ?>
                                                <tr>
                                                    <td><?= $i++;?></td>
                                                    <td><?php if(!empty($users->orderno)) {echo $users->orderno;} ?></td>
                                                    <td><?php if(!empty($users->pay_id)) { echo $getpay[0]->pay_id;}?></td>
                                                    <td><?php if(!empty($users->date)) {echo date('d-m-Y',strtotime($users->date));} ?></td>
                                                    <td><a href="<?= base_url().'property/invoicelist/'.sqftEncrypt($users->orderno);?>"><i class="fa fa-eye"></a></td>
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



