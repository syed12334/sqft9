<?php //echo "<pre>";print_r($getUsers);exit; ?>
<?= $header;?>
<style type="text/css">
    .print-button-container {
    width: 100%;
    text-align: center;
}
    .print-button {
    line-height: 27px;
    font-size: 16px;
    font-weight: 400;
    color: #fff;
    background-color: #232936;
    box-shadow: 0 2px 8px rgb(0 0 0 / 10%);
    border-radius: 4px;
    padding: 10px 20px;
    display: inline-block;
    text-align: center;
    margin-bottom: 2.5rem;
    transition: .3s;
    text-decoration: none!important;
    outline: none!important;
    width: auto;
}

@media print {
    .print-button {
        display: none!important
    }
    .user-dash {
        display: none!important
    }
    #header {
        display: none!important
    }
    .first-footer {
        display: none!important
    }
    .h2 .font-weight-light {
        color:#000!important;
        font-weight: 900!important
    }
    .mb-2 {
        color:#000!important;
    }
    .dropbtn {
        display: none!important
    }
    .bg-dark {
    background-color: #343a40!important;
}
}
</style>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                   <!-- Print Button -->
                        <div class="print-button-container">
                            <a href="javascript:window.print()" class="print-button">Print this invoice</a>
                        </div>
                        <div class="invoice mb-0">
                            <div class="card border-0">
                                <div class="card-body p-0">
                                    <div class="row p-5 the-five">
                                        <div class="col-md-6">
                                            <img src="<?= asset_url();?>images/logo.png" width="80" alt="Logo">
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <p class="font-weight-bold mb-1">Invoice <?php if(!empty($getUsers[0]->inoiceno)) {echo "#".$getUsers[0]->inoiceno;} ?></p>
                                        </div>
                                    </div>

                                    <hr class="my-5">

                                    <div class="row pb-5 p-5 the-five">
                                        <div class="col-md-6">
                                            <h3 class="font-weight-bold mb-4">Invoice To</h3>
                                            <p class="mb-0 font-weight-bold"><?php if(!empty($getUsers[0]->name)) {echo ucfirst($getUsers[0]->name);} ?></p>
                                            <p class="mb-0"><?php if(!empty($getUsers[0]->address)) {echo ucfirst($getUsers[0]->address);} ?></p>
                                        </div>

                                        <div class="col-md-6 text-right">
                                            <h3 class="font-weight-bold mb-4">Payment Details</h3>
                                            
                                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Online</p>
                                            
                                        </div>
                                    </div>

                                    <div class="row p-5 the-five">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th class="border-0 text-uppercase small font-weight-bold">Package Name</th>
                                                        <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                                        <th class="border-0 text-uppercase small font-weight-bold">Payment ID</th>
                                                
                                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $ar =[];
                                                        if(count($getuserpackage)) {
                                                            foreach ($getuserpackage as $key => $value) {
                                                                $ar[] = $value->price;
                                                                 $uid = $value->user_id;
                                                $getpay = $this->master_db->getRecords('payment_log',['user_id'=>$uid],'*');
                                                               ?>
                                                                 <tr>
                                                                    <td><?php if(!empty($value->orderno)) {
                                                                       echo $value->orderno; 
                                                                    } ?></td>
                                                        <td><?php if(!empty($value->title)) { echo $value->title; }?></td>
                                                        <td><i class="fa fa-rupee"></i><?php if(!empty($value->pprice)) {echo  number_format($value->pprice);}?></td>
                                                        <td><?php if(!empty($getpay[0]->pay_id)) {echo $getpay[0]->pay_id;} ?></td>
                                                        <td><i class="fa fa-rupee"></i><?= number_format($value->price);?></td>
                                                    </tr>
                                                               <?php
                                                            }
                                                        }
                                                    ?>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                                        <div class="py-3 px-5 text-left">
                                            <div class="mb-2">Grand Total</div>
                                            <div class="h2 font-weight-light"><i class="fa fa-rupee"></i> <?php echo number_format(array_sum($ar));?></div>
                                        </div>

                                        <!-- <div class="py-3 px-5 text-right">
                                            <div class="mb-2">Discount</div>
                                            <div class="h2 font-weight-light">10%</div>
                                        </div> -->

                                        <div class="py-3 px-5 text-left">
                                            <div class="mb-2">Sub - Total</div>
                                            <div class="h2 font-weight-light"><i class="fa fa-rupee"></i> <?php echo number_format(array_sum($ar));?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>



