  <?= $header?>
  <style type="text/css">
      .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  right: 10px
}

  </style>
      <section class="headings">
            <div class="text-heading text-center">
                <div class="container">
                    <h1>Sign In</h1>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADINGS -->
        <!-- START SECTION LOGIN -->
        <div id="login">
            <div class="login">
                <div id="error"></div>
                <form method="post">
                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="email" >
                        <i class="icon_mail_alt"></i>
                    </div>

                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" >
                        <i class="icon_mail_alt"></i>
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="fl-wrap filter-tags clearfix add_bottom_30">
                        <div class="checkboxes float-left">
                            <div class="filter-tags-wrap">
                                <input id="check-b" type="checkbox" name="check">
                            </div>
                        </div>
                        <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                    </div>
                    <button type="submit" id="submit" class="btn_1 rounded full-width">Sign In</button>
                    <div class="text-center add_top_10">New to sqft9 ?  <strong style="margin-left:5px"><a href="<?= base_url().'home/register';?>">Sign up!</a></strong></div>
                </form>
            </div>
        </div>
        <!-- END SECTION LOGIN -->

       <?= $footer?>
       <script type="text/javascript">
           $(document).ready(function() {
            $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
                $("#submit").on('click',function(e) {
                        e.preventDefault();
                        var email = $("#email").val();
                        var password = $("#password").val();
                        if($.trim(email) =="") {
                            $("#error").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter email id</div>');
                            return false;
                        }else if($.trim(password) =="") {
                             $("#error").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter password</div>');
                            return false;
                        }else {
                            $.ajax({
                                url :"<?= base_url().'login/checklogin'; ?>",
                                method:"post",
                                data :{
                                    email :email,
                                    password:password,
                                    "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                                },
                                dataType :"json",
                                success:function(data) {
                                    if(data.msg ==1) {
                                         $(".csrf_token").val(data.csrf_token);
                                        window.location.href="<?= base_url();?>";
                                    }else if(data.msg ==-1) {
                                         $(".csrf_token").val(data.csrf_token);
                                      $("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>Verification Pending</div>");
                                    }else if(data.msg ==0) {
                                         $(".csrf_token").val(data.csrf_token);
                                        $("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid email or password</div>");

                                    }
                                    
                                }
                            });
                        }
                });
           });
       </script>