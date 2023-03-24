<?php //echo "<pre>";print_r($userdata);exit; ?>
<?= $header; ?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    
                        <div class="my-properties" id="newitem">
                            <div id="message"></div>
                        	<form method="post" action="<?= base_url().'property/addNewpackage';?>">
                        		   <input type="hidden" name="name" id="namepop" >
    <input type="hidden" name="email" id="emailpop" value="<?= $userdata[0]->email?>">
    <input type="hidden" name="phone" id="phonepop" value="<?= $userdata[0]->phone?>">
    <input type="hidden" name="name" id="name" value="<?= $userdata[0]->name?>">
      <div class="row">
                        <?php 
                            if(count($package)) {
                                foreach ($package as $key => $value) {
                                   ?>
                                  
                                     <div class="col-lg-3 col-md-6 col-xs-12">
                            <div class="plan text-center">
                                <span class="plan-name"> <?= $value->title?><small> Subcription <br> Fees
                                        Applicable</small></span>
                                <p class="plan-price"><sup class="currency">$</sup><strong><?= $value->pprice?></strong><sub>.00</sub>
                                </p>
                                <ul class="list-unstyled">
                                    <li><?= $value->nmonths?></li>
                                    <li><?= $value->nproperties?></li>
                                    <?php
                                        if(!empty($value->npictures)) {
                                            ?>
                                            <li><?= $value->npictures?> </li>
                                            <?php
                                        }
                                    ?>
                                     
                                </ul>
                                <label class="choose"> 
                                    <input type="checkbox" name="package[]" id="package" value="<?= $value->id;?>"/> Choose</label>
                            </div>
                        </div>
                 
                                   <?php
                                }
                            }

                        ?>
                           </div>
                            <div class="text-center"> <button type="submit" id="submit"  class="btn btn-primary" >Pay Now</button></div>
                       </form>
                        
                        </div>
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
<?= $footer; ?>

<script type="text/javascript">
            $(document).ready(function() {
            $("#submit").on("click",function(e) {
                e.preventDefault();
                var package = [];
                var name = $("#namepop").val();
                var email = $("#emailpop").val();
                var phone = $("#phonepop").val();
                var name = $("#name").val();
                $("input[name='package[]']:checked").each(function() {
                    package.push($(this).val());
                });
                 $.ajax({
                    url : "<?= base_url().'property/payment';?>",
                    method:"post",
                    data: {name:name,email:email,phone:phone,name:name,package:package, "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},
                    dataType:"json",
                    success:function(res) {
                        $(".csrf_token").val(res.csrf_token);
                    if(res.status ==true) {
                        $("#newitem").html(res.msg);
                    }else if(res.status ==false) {
                        $("#message").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'+res.msg+'</div>');
                    }
            }
       });
            });
        });
</script>