<?= $header;?>
<style type="text/css">
  #file-error {
    color:red;
  }
 
</style>
<div class="page has-sidebar-left bg-light height-full">
 <div class="container-fluid my-3">
        <div class="row">
         
                    <div class="card my-3 no-b" style="width:100%">
                    <div class="card-body">
                           <?php 
                        if(!empty($partners) && is_array($partners)) {
                            ?>
                            <div class="card-title">Edit Partners</div>
                            <?php
                        }else {
                           ?>
                            <div class="card-title">Add Partners</div>
                            <?php
                        }
                      ?>
                                    <?php
                               if(!empty($partners) && is_array($partners)) {
                            ?>
                            <?php
                              if(count($partners) >0) {
                                ?>
                                          <form id="subscription" action="<?= base_url().'master/partnerssave';?>" method="post" style="margin-top:40px" enctype="multipart/form-data">
                                  <div class="row">
                                  <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                  <input type="hidden" name="id" id="pid" value="<?= $partners[0]->id;?>">
                                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
                            <label>Partner Image <span style="color:red">*</span></label>
                               <input type="file" name="file" id="file" class="form-control"  required>
                           </div>  
                           <?php
                            if(!empty($partners[0]->image)) {
                              ?>
                                <img src="<?= app_url().$partners[0]->image?>" style="width:100px">
                              <?php
                            }
                           ?>                
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
<div class="clearfix"></div>

                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                           </div>
                         </div>
                           
                       </form>

                                <?php
                              }else {
                                  redirect('partners');
                              }
                            ?>
                       
                            <?php
                          }else {
                            ?>
                               <form id="subscription" action="<?= base_url().'master/partnerssave';?>" method="post" style="margin-top:40px" enctype="multipart/form-data">
                                  <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="row">
                                                                  <input type="hidden" name="id" id="pid" value="">
     

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
                            <label>Image <span style="color:red">*</span></label>
                               <input type="file" name="file" id="file" class="form-control"  required>
                           </div>                  
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
<div class="clearfix"></div>

                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <button class="btn btn-primary" type="submit" id="submit">Submit</button>
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
                file: {
                     required: true,
                  
                },
  
            },
            messages: {
                file: "Please upload image",
                
            },
              
        });
              
            });
</script>