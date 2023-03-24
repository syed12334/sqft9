
<?= $header?>
  <style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  right: 10px
}
.popup-detail {
background-color: #f5f7fb;
position: fixed;
left: 0;
top: -100%;
height: 100%;
width: 100%;
z-index: 99999999;
transition: 0.5s;
display: none;
}

.popup-detail.intro {
top: 0;
display: block;
overflow: auto;
}

.close-d {
    float: right;
    font-size: 18px;
    margin: 20px 30px 0 0;
    cursor: pointer;
    border: 1px solid red;
    color: red;
    padding: 3px 17px;
}
#name-error {
    color:red!important;
}
#email-error {
    color:red!important;
}
#phone-error {
    color:red!important;
}
#password-error {
    color:red!important;
}
#terms-error {
    color:red!important;
}

#message {
    position: fixed;
    top:20px;
    right:10px;
    z-index:9999999999999!important;
}
    </style>
        <section class="headings">
            <div class="text-heading text-center">
                <div class="container">
                    <h1>Register</h1>
                    <h2><a href="index.html">Home </a> &nbsp;/&nbsp; Register</h2>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADINGS -->

        <!-- START SECTION 404 -->
        <div id="login">
            <div class="login">
                <?php
                    if($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');
                    }
                ?>
                <form autocomplete="off" id="form" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" id="name" autocomplete="off" required>
                        <i class="ti-user"></i>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" id="email" autocomplete="off" required>
                        <i class="ti-user"></i>
                        <div id="emailError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" id="password" autocomplete="off" required>
                        <i class="icon_mail_alt"></i>
                         <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input class="form-control" type="number" id="phone"  name="phone" autocomplete="off" required>
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="form-group">
                        <label>Select State</label>
                       <select name="state" id="state" class="form-control" required>
                           <option value="">Select State</option>
                           <?php
                            if(count($state)) {
                                foreach ($state as  $value) {
                                   ?>
                                   <option value="<?= $value->id?>"><?= $value->name;?></option>
                                   <?php
                                }
                            }
                           ?>
                       </select>
                    </div>

                    <div class="form-group">
                        <label>Select City</label>
                       <select name="city" id="city" class="form-control" required>
                           <option value="">Select City</option>
                       </select>
                    </div>

                     <div class="form-group">
                        <label>Aadhaar Card Number</label>
                       <input type="number" name="aadharno" id="aadharno" placeholder="Enter Aadhaar Number(Optional)" class="form-control">
                    </div>
                    
                    <div id="pass-info" class="clearfix"></div>
                   <input type="checkbox" name="terms" id="terms" value="1" required> Read and accept <a href="<?= base_url().'terms';?>">Terms & Conditions</a><br />
                   
                  

 <button type="submit" class="btn_1 rounded  full-width add_top_30" id="next" style="margin-top:20px">Next</button>

                    

                    <div class="text-center add_top_10">Already have an acccount? <strong><a href="<?= base_url().'login';?>">Sign In</a></strong></div>
                </form>
            </div>
        </div>
        <!-- END SECTION 404 -->

         <div class="popup-detail" id="newitem">

            <div class="container">
            <a href="index.html" class="pull-left"><img src="<?= asset_url();?>images/logo.png" style="width: 110px;" data-sticky-logo="images/logo.png"
                alt="" ></a>

            <span class="close-d">Close </span>
        </div>
            
            <!-- END SECTION HEADINGS -->

            <!-- START SECTION PRICING -->
            <section class="pricing-table bg-white-2 mt-5">
             
<form method="post" action="<?= base_url().'';?>">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
    <input type="hidden" name="name" id="namepop" >
    <input type="hidden" name="email" id="emailpop">
    <input type="hidden" name="phone" id="phonepop">
    <input type="hidden" name="pass" id="passpop">
                <div class="container">
                        
                    <div class="section-title">
                        <div id="message"></div>
                        <h3>Pricing</h3>
                        <h2>Choose Subscription Package </h2>
                    </div>
                    <div class="row">
                        <!-- plan start -->
   
                        <?php 
                            if(count($package)) {
                                foreach ($package as $key => $value) {
                                   ?>
                                     <div class="col-lg-3 col-md-6 col-xs-12">
                            <div class="plan text-center">
                                <span class="plan-name"> <?= $value->title?></span>
                                <p class="plan-price"><sup class="currency"><i class="fa fa-rupee"></i></sup><strong><?= $value->pprice?></strong><sub>.00</sub>
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
                                    <input type="hidden" name="packagetype[]" value="<?= $value->type;?>">
                                    <input type="checkbox" name="package[]" id="package" value="<?= $value->id;?>"/> Choose</label>
                            </div>
                        </div>
                                   <?php
                                }
                            }

                        ?>
                      
                 



                    </div>




                </div>

 <div class="fixed-bottom bg-white p-3 text-center shadow-top"> <!-- <button type="submit" id="submit" class="btn btn-primary">PROCEED TO PAYMENT</button>  -->

<!--     <button type="submit" id="submit" class="btn btn-primary">CONFIRM</button>
 -->    <button type="submit" id="submit" class="btn btn-primary">PROCEED TO PAYMENT</button>
  <button id="back" class="btn btn-primary">Back</button></div>

                  </form>
            </section>

           
            <!-- END SECTION PRICING -->
        </div>

 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">

    <?= $footer;?>

  <script>
            $(document).ready(function () {

                    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

                $("#back").on("click",function(e) {
                    e.preventDefault();
                    $('.popup-detail').removeClass('intro');
                });
                $('.open-pop').click(function () {
                    $('.popup-detail').addClass('intro');
                });
                $('.close-d').click(function () {
                    $('.popup-detail').removeClass('intro');
                });
            });



        $(document).ready(function() {
            $('body').on("click","#submit",function(e) {
                e.preventDefault();
                var package = [];
                var name = $("#namepop").val();
                var email = $("#emailpop").val();
                var phone = $("#phonepop").val();
                var pass = $("#passpop").val();
                var state = $("#state").val();
                var city = $("#city").val();
                var terms = $("#terms").val();
                var aadharno = $("#aadharno").val();
                $("input[name='package[]']:checked").each(function() {
                    package.push($(this).val());
                });
                 $.ajax({
                    url : "<?= base_url().'home/payment';?>",
                    method:"post",
                    data: {name:name,email:email,phone:phone,pass:pass,package:package,state:state,city:city,terms:terms,aadharno:aadharno, "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},
                    dataType:"json",
                    success:function(res) {
                    if(res.status ==true) {
                        $("#newitem").html(res.msg);
                    }else if(res.status ==false) {
                        $("#message").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'+res.msg+'</div>');
                          $(".csrf_token").val(data.csrf_token);
                    }
            }
       });
            });
        });
    $(document).ready(function() {
        $("#form").validate({
            rules: {
                name: {
                     required: true,
                    minlength: 3,
                    maxlength :20
                },
               
                email: {
                    required: true,
                    email: true
                },
                 password: {
                    required: true,
                    minlength: 6,
                 },
                phone :{
                     required: true,
                    number: true,
                     minlength: 10,
                     maxlength:10
                },
                state : {
                    required :true
                },
                city : {
                    required:true
                },
                 terms : {
                    required:true
                },
            },
            messages: {
                name: "Please enter name",
                email: "Please enter a valid email address",
                password: "Please enter password",
                phone: "Please enter 10 digit phone number",
                state: "Please select state",
                city: "Please select city",
                terms: "Please check terms & conditions",
            },
              submitHandler: function (form) {
                  var name = $("#name").val();
                    var email = $("#email").val();
                    var phone = $("#phone").val();
                    var pass = $("#password").val();
                    $("#namepop").val(name);
                    $("#emailpop").val(email);
                    $("#phonepop").val(phone);
                    $("#passpop").val(pass);
                    $.ajax({
                        url :"<?= base_url().'home/emailvalid';?>",
                        method:"post",
                        dataType:"json",
                        data :{
                            email :email,
                            "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                          
                        },
                        success:function(data) {
                            if(data.status ==true) {
                                $(".csrf_token").val(data.csrf_token);
                                $('.popup-detail').addClass('intro');
                            }else if(data.status ==false) {
                                $(".csrf_token").val(data.csrf_token);
                                $("#emailError").html('<p style="color:red">'+data.msg+'</p>');
                            }
                        }   
                    });
         }
        });
              
            });



        $(document).ready(function() {
                $("#state").on("change",function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                   $.ajax({
                        url :"<?= base_url().'home/getCity'; ?>",
                        method:"post",
                        data :{
                            sid :id,
                            "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                        },
                        dataType:"json",
                        success:function(data) {
                                $("#city").html(data.msg);
                                $(".csrf_token").val(data.csrf_token);
                        }
                   });
                });
        });
        </script>