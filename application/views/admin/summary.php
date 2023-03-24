
  <!-- START SECTION PAYMENT-METHOD -->
        <section class="payment-method notfound" style="padding:50px 0px">
            <div class="container">
              
                <section class="headings-2 pt-0 hee">
                    <div class="pro-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                           
                                <h3>Subscription Summary</h3>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tr-single-box mb-0">
                            <div class="tr-single-body">

                                <div class="news-item news-item-sm mb-5">
                                   
                                    <div class="news-item-text">
                                        <a href="agent-details.html"><h3>Subscription Summary</h3></a>
                                        <div class="the-agents">
                                            <ul class="the-agents-details">
                                                <li>Name: <?= $postData['name']?></li>
                                                <li>Email: <?= $postData['email']?></li>
                                                <li>Phone Number:<?= $postData['phone']?></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="booking-price-detail side-list no-border">
                                    <h5>Package Details</h5>
                                    <ul>
                                    	<?php
                                    	$price =[];
                                    		if(count($package)) {
                                    			foreach ($package as $key => $value) {
                                    				$price[] = $value->pprice;
                                    				?>
                                    				 <li><?= $value->title;?><strong class="pull-right"><i class="fa fa-rupee"></i><?= number_format($value->pprice,2)?></strong></li>
                                    				<?php
                                    			}
                                    		}

                                    	?>
                                       
                                        <hr />
                                        
                                        <li class="red pb-0">Total Cost<strong class="pull-right"><i class="fa fa-rupee"></i><?= number_format(array_sum($price),2);?></strong></li>
                                    </ul>
                                </div>

                                <div class="p-3 text-center" style="margin-top:30px"><button type="submit" class="btn btn-primary" id="payBtn">PAY NOW</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
<script src="<?= asset_url();?>js/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_live_TFHJWLCUx9Y4od", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo array_sum($price)*100;?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "<?php echo $postData['name']; ?>",
    "description": "Sqrt",
    "image": "<?= base_url().'assets/images/logo.png';?>",
    
    "handler": function (response){
        console.log(response);
        var payid = response.razorpay_payment_id;
        var pid = "";
       $.ajax({
            url : "<?= base_url().'property/addNewpackage';?>",
            method:"post",
            data: {payid:payid,pid:pid,"<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},
            dataType:"json",
            success:function(res) {
                $(".csrf_token").val(res.csrf_token);
                if(res.status ==true) {
                      window.location.href="<?= base_url();?>property/thankyou";
                }else if(res.status ==false) {
                }
            }
       });
    },
    
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('payBtn').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>