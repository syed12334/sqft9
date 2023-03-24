<?php //echo "<pre>";print_r($package);exit;?>
<?= $header;?>
<div id="preloader"></div>
       <section style="margin:90px 0px">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"></div>
                   <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <div class="subcription">
                      <?php 
                        if(!empty($package) && is_array($package)) {
                            ?>
                            <h3>Edit Subscription</h3>
                            <?php
                        }else {
                           ?>
                            <h3>Add Subscription</h3>
                            <?php
                        }
                      ?>
                        
                        <hr>
                        <?php
                               if(!empty($package) && is_array($package)) {
                            ?>
                                 <form action="" id="subscription" method="post" style="margin-top:40px">
                                  <input type="hidden" name="id" id="pid" value="<?= $package[0]->id;?>">
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
                                   <option value="3" <?php if($package[0]->type ==3) {
                                    echo "selected";
                                   } ?>>Buy</option>
                               </select>
                               <span id="typeerror" style="color:red"></span>
                           </div>

                           <div class="form-group">
                            <label>Subscription Title <span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?= $package[0]->title?>">
                               <span id="titleerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Package Price <span style="color:red">*</span></label>
                               <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?= $package[0]->pprice?>">
                               <span id="priceerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Validity in Months <span style="color:red">*</span></label>
                               <input type="text" name="vmonths" id="vmonths" class="form-control" placeholder="Enter Validity in Months" value="<?= $package[0]->nmonths?>">
                               <span id="validerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Number of Properties Based on Type of Subscription <span style="color:red">*</span></label>
                               <input type="text" name="noftype" id="noftype" class="form-control" placeholder="Enter Number of Properties " value="<?= $package[0]->nproperties?>">
                               <span id="noftypeerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Number of Pictures</label>
                               <input type="text" name="noofpics" id="noofpics" class="form-control" placeholder="Enter Number of Pictures" value="<?= $package[0]->npictures?>">
                           </div>

                           <center>
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </center>
                           
                       </form>
                            <?php
                          }else {
                            ?>
                               <form action="" id="subscription" method="post" style="margin-top:40px">
                                                                  <input type="hidden" name="id" id="pid" value="">

                           <div class="form-group">
                            <label>Select Type <span style="color:red">*</span></label>
                               <select name="type" class="form-control" id="type" >
                                   <option value="">Select type</option>
                                   <option value="1">Rent</option>
                                   <option value="2">Sale</option>
                               </select>
                               <span id="typeerror" style="color:red"></span>
                           </div>

                           <div class="form-group">
                            <label>Subscription Title <span style="color:red">*</span></label>
                               <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" >
                               <span id="titleerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Package Price <span style="color:red">*</span></label>
                               <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" >
                               <span id="priceerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Validity in Months <span style="color:red">*</span></label>
                               <input type="text" name="vmonths" id="vmonths" class="form-control" placeholder="Enter Validity in Months" >
                               <span id="validerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Number of Properties Based on Type of Subscription <span style="color:red">*</span></label>
                               <input type="text" name="noftype" id="noftype" class="form-control" placeholder="Enter Number of Properties " >
                               <span id="noftypeerror" style="color:red"></span>
                           </div>

                            <div class="form-group">
                            <label>Number of Pictures</label>
                               <input type="text" name="noofpics" id="noofpics" class="form-control" placeholder="Enter Number of Pictures">
                           </div>

                           <center>
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </center>
                           
                       </form>
                            <?php
                          }
                        ?>
                       
                    
                   </div>
                   </div>
                   <div class="clearfix"></div>
               </div>
           </div>
       </section>


<?= $footer;?>
<script type="text/javascript">
 $(document).ready(function() {
    $("#submit").on("click",function(e) {
        e.preventDefault();
        var type = $("#type").val();
        var title = $("#title").val();
        var price = $("#price").val();
        var vmonths = $("#vmonths").val();
        var noftype = $("#noftype").val();
        var noofpics = $("#noofpics").val();
        var id = $("#pid").val();

        if($.trim(type) =="") {
          $("#typeerror").html('Type is required');
          return false;
        }
        else if($.trim(title) =="") {
          $("#titleerror").html('Title is required');
          return false;
        }
         else if($.trim(price) =="") {
          $("#priceerror").html('Price is required');
          return false;
        }
        else if($.trim(vmonths) =="") {
          $("#vmonthserror").html('Validity month is required');
          return false;
        }else {
          $.ajax({
              url :"<?= base_url().'admin/register';?>",
              method :"post",
              dataType:"json",
              data :{
                id:id,
                type :type,
                price :price,
                title:title,
                vmonths :vmonths,
                noftype :noftype,
                noofpics:noofpics
              },
              success:function(data) {
                if(data.status ==true) {
                  console.log(data);
                  window.location.href="<?= base_url().'admin/subscriptionList';?>";
                }else if(data.status ==false){
                  $("#message").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+'</div>');
                }
              }
          });
        }

    });
 });
</script>