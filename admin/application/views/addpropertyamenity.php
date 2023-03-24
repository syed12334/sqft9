<?php //echo "<pre>";print_r($property);exit;?>
<?= $header;?>
<style type="text/css">
  #title-error {
    color:red;
  }
  #type-error {
    color:red;
  }
</style>
<div class="page has-sidebar-left bg-light height-full">
 <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
                    <div class="card my-3 no-b">
                    <div class="card-body">
                           <?php 
                        if(!empty($amenities) && is_array($amenities)) {
                            ?>
                            <div class="card-title">Edit Property Category</div>
                            <?php
                        }else {
                           ?>
                            <div class="card-title">Add Property Category</div>
                            <?php
                        }
                      ?>
                                    <?php
                               if(!empty($amenities)) {
                            ?>
                                 <form action="" id="amenity" method="post" style="margin-top:40px">
                                  <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                  <input type="hidden" name="id" id="pid" value="<?= $amenities[0]->id;?>">
                     <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                              <label>Select Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                        if(count($category)) {
                                            foreach ($category as $key => $value) {
                                                $ptype = $value->id;
                                             ?>
                                             <option value="<?= $value->id?>" <?php if($ptype == $amenities[0]->ptype) {echo "selected"; }?>><?= $value->name?></option>
                                             <?php
                                            }
                                        }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                           <div class="form-group">
                            <label>Title <span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?= $amenities[0]->title?>">
                               <span id="titleerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="cleafix"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <center>
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </center>
                         </div>
                           </div>
                       </form>
                            <?php
                          }else {
                            ?>
                               <form action="" id="amenity" method="post" style="margin-top:40px">
                                <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                                                  <input type="hidden" name="id" id="pid" value="">
<div class="form-group">
    <label>Select Type</label>
                          <select name="type" id="type" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                        if(count($category)) {
                                            foreach ($category as $key => $value) {
                                             ?>
                                             <option value="<?= $value->id?>"><?= $value->name?></option>
                                             <?php
                                            }
                                        }
                                    ?>
                                </select>
</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                           <div class="form-group">
                            <label>Title<span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" >
                               <span id="titleerror" style="color:red"></span>
                           </div>

                        </div>
                        <div class="cleafix"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <center>
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </center>
                        </div>    

                          
                          </div> 
                       </form>
                            <?php
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $footer;?>


<script type="text/javascript">
 $(document).ready(function() {
      $("#amenity").validate({
            rules: {
                type: {
                     required: true,
                  
                },
                title: {
                    required: true,
                    minlength: 3,
                     maxlength:30
                }
            },
            messages: {
                type: "Please select type",
                title: "Title must be 3-30 chars long",
            },
              submitHandler: function (form) {
                  var title = $("#title").val();
                  var type = $("#type").val();
                  var id = $("#pid").val();
                    $.ajax({
                        url :"<?= base_url().'master/addamenitysave';?>",
                        method:"post",
                        dataType:"json",
                        data :{
                          id:id,
                          title:title,
                          type :type,
                          "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                        },
                        beforeSend:function() {
                          $("#submit").prop('disabled',true);
                          $("#submit").text('Submitting please wait');
                        },
                        success:function(data) {
                            if(data.status ==true) {
                              $(".csrf_token").val(data.csrf_token);
                               window.location.href="<?= base_url().'amenities';?>";
                            }else if(data.status ==false) {
                               $(".csrf_token").val(data.csrf_token);
                               $("#message").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+'</div>');
                                
                            }
                        }   
                    });
                }
            });
        });
</script>