<?= $header; ?>
    <section style="margin:140px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
    					<h3 style="text-align: center;">New package <?php if($this->session->userdata('packagename')) { echo $this->session->userdata('packagename');}?> has been successfully added to your account  .</h3>
    					<h3 style="text-align: center;"> Regards Team sqft9</h3>
                        <br />
                        <center><a href="<?= base_url().'property/subscriptionList'; ?>" style="background: #0e183c;padding:10px 30px;color:#fff;margin-top:20px">View My Subscriptions</a></center>
                     </div>

                 </div>
                </div>
          
        </section>

        <?= $footer; ?>
