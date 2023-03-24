<?= $header;?>
<style type="text/css">
  #type-error {
    color:red;
  }
    #title-error {
    color:red;
  }
    #price-error {
    color:red;
  }
    #vmonths-error {
    color:red;
  }
</style>
<div class="page has-sidebar-left bg-light height-full">
 <div class="container-fluid my-3">
        <div class="row">
         
                    <div class="card my-3 no-b">
                    <div class="card-body">
                           <?php 
                        if(!empty($package) && is_array($package)) {
                            ?>
                            <div class="card-title">Edit Subscription</div>
                            <?php
                        }else {
                           ?>
                            <div class="card-title">Add Subscription</div>
                            <?php
                        }
                      ?>
                                    <?php
                               if(!empty($package) && is_array($package)) {
                            ?>
                            <?php
                              if(count($package) >0) {
                                ?>
                                          <form id="subscription" style="margin-top:40px">
                                  <div class="row">
                                  <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                  <input type="hidden" name="id" id="pid" value="<?= $package[0]->id;?>">
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                            <label>Select Type <span style="color:red">*</span></label>
                               <select name="type" class="form-control" id="type" >
                                   <option value="">Select type</option>
                                   <option value="1" <?php if($package[0]->type ==1) {
                                    echo "selected";
                                   } ?>>Rent</option>
                                   <option value="2" <?php if($package[0]->type ==2) {
                                    echo "selected";
                                   } ?>>Sale</option>
                                   
                               </select>
                               <span id="typeerror" style="color:red"></span>
                           </div>

                         </div>
                           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                            <label>Subscription Title <span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?= $package[0]->title?>">
                               <span id="titleerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Package Price <span style="color:red">*</span></label>
                               <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?= $package[0]->pprice?>">
                               <span id="priceerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Validity in Months <span style="color:red">*</span></label>
                               <input type="text" name="vmonths" id="vmonths" class="form-control" placeholder="Enter Validity in Months" value="<?= $package[0]->nmonths?>">
                               <span id="validerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Number of Properties Based on Type of Subscription <span style="color:red">*</span></label>
                               <input type="text" name="noftype" id="noftype" class="form-control" placeholder="Enter Number of Properties " value="<?= $package[0]->nproperties?>">
                               <span id="noftypeerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Number of Pictures</label>
                               <input type="text" name="noofpics" id="noofpics" class="form-control" placeholder="Enter Number of Pictures" value="<?= $package[0]->npictures?>">
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <center>
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </center>
                         </div>
                           </div>
                       </form>

                                <?php
                              }else {
                                  redirect('subscription');
                              }
                            ?>
                       
                            <?php
                          }else {
                            ?>
                               <form id="subscription" style="margin-top:40px">
                                  <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="row">
                                                                  <input type="hidden" name="id" id="pid" value="">
                                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                            <label>Select Type <span style="color:red">*</span></label>
                               <select name="type" class="form-control" id="type" >
                                   <option value="">Select type</option>
                                   <option value="1">Rent</option>
                                   <option value="2">Sale</option>
                               </select>
                               <span id="typeerror" style="color:red"></span>
                           </div>
                         </div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                            <label>Subscription Title <span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" >
                               <span id="titleerror" style="color:red"></span>
                           </div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Package Price <span style="color:red">*</span></label>
                               <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" >
                               <span id="priceerror" style="color:red"></span>
                           </div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Validity in Months <span style="color:red">*</span></label>
                               <input type="text" name="vmonths" id="vmonths" class="form-control" placeholder="Enter Validity in Months" >
                               <span id="validerror" style="color:red"></span>
                           </div>
                         </div>
                         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                            <div class="form-group">
                            <label>Number of Properties Based on Type of Subscription <span style="color:red">*</span></label>
                               <input type="text" name="noftype" id="noftype" class="form-control" placeholder="Enter Number of Properties " >
                               <span id="noftypeerror" style="color:red"></span>
                           </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                            <label>Number of Pictures</label>
                               <input type="text" name="noofpics" id="noofpics" class="form-control" placeholder="Enter Number of Pictures">
                           </div>
</div>
<div class="clearfix"></div>
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
<?= $footer;?>


<script type="text/javascript">
  $(document).ready(function() {
     
      $("#subscription").validate({
            rules: {
                type: {
                     required: true,
                  
                },
                title: {
                    required: true,
                    minlength: 3,
                     maxlength:50
                },
                 price: {
                    required: true,
                    number: true,
                 },
                vmonths :{
                     required: true,
                     
                },
                
            },
            messages: {
                type: "Please select type",
                
                title: "It must be 3-50 chars long",
                price: "Please enter price",
                vmonths: "Please enter validity",
            },
              submitHandler: function (form) {
                  var type = $("#type").val();
                  var title = $("#title").val();
                  var price = $("#price").val();
                  var vmonths = $("#vmonths").val();
                  var noftype = $("#noftype").val();
                  var noofpics = $("#noofpics").val();
                  var id = $("#pid").val();
                  //console.log(form);
                    $.ajax({
                        url :"<?= base_url().'master/register';?>",
                        method:"post",
                        dataType:"json",
                        data :{
                          id:id,
                          type :type,
                          price :price,
                          title:title,
                          vmonths :vmonths,
                          noftype :noftype,
                          noofpics:noofpics,
                          "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                        },
                        beforeSend:function() {
                          $("#submit").prop('disabled',true);
                          $("#submit").text('Submitting please wait');
                        },
                        success:function(data) {
                            if(data.status ==true) {
                              $(".csrf_token").val(data.csrf_token);
                               window.location.href="<?= base_url().'subscription';?>";
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