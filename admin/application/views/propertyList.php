<?= $header;?>
<style type="text/css">
    .btns {
        background-color: none!important;
    }
    button {
        background-color: none!important;
    }
</style>
<div class="page has-sidebar-left bg-light height-full">
 <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
                    <div class="card my-3 no-b">
                    <div class="card-body">
                        <h3 class="card-title" style="margin-left:20px">Property List</h3>
                        <?php 
                            if($this->session->flashdata('message')) {
                                echo $this->session->flashdata('message');
                            }
                        ?>
                     
                            <table id="category_table" class="table display table-bordered table-striped no-wrap" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Action</th>
                                        <th>Owner Name</th>
                                        <th>Property Type</th>
                                        <th>Property Name</th>
                                        
                                        <th>Rent / Sell</th>
                                        <th>Created Date</th>                    
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
     <div class="popup-detail" id="newitem">
         <a href="index.html" class="pull-left"><img src="<?= app_asset_url();?>images/logo.png" style="width: 110px;margin:30px 20px" data-sticky-logo="images/logo.png"
                alt="" ></a>

            <span class="close-d" onclick="closeD()">Close </span>

             <section class="single-proper blog details" id="viewDetails">

        </section>
     </div>

      <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Owner Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="owner">
            
        </div>
       
        
      </div>
    </div>
  </div>
<?= $footer;?>
<?php $csrf = array('name' => $this->security->get_csrf_token_name(),'hash' => $this->security->get_csrf_hash()); ?>
<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
<script type="text/javascript">
    var dataTable, edit_data;
            function initialiseData(){
                dataTable = $('#category_table').DataTable({  
                    "processing":true,  
                    "serverSide":true,  
                    "searching": true,
                    "order":[],  
                    "ajax":{  
                        url:"<?=base_url().'master/getPropertylist'?>",  
                        type:"POST",
                        data: function(d){
                            //d.form = $("#searchForm").serializeArray();
                            <?php echo "d.".$csrf['name'];?> = $(".csrf_token").val();
                        },
                        error: function(){  // error handling
                            $(".user_data-error").html("");
                            $("#user_data").append('<tbody class="user_data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                            $("#user_data_processing").css("display","none");
                        }
                    },
                                columnDefs:[  
                  {  
                       "targets":[2,4,6],  
                       "orderable":true,  
                  },  
                  {  
                       "targets":[0,1,5],  
                       "orderable":false,  
                  },
            ], 
            "drawCallback": function (response) {               
                var res = response.json;
                $(".csrf_token").val(res.csrf_token);
                
            }
                }); 
            }
            initialiseData();
                function updateStatus(id,status){
                       var postdata = { id : id,status : status,"<?= $this->security->get_csrf_token_name();?>":$(".csrf_token").val() } ;
                        //console.log( postdata );
                        $.ajax({                        
                            url: "<?=base_url().'master/setpropertylistview'?>",
                            type: "post",
                            data:  postdata ,
                            dataType : 'json',
                            success: function (response) {
                                //console.log(response);
                                if(response.status == '1'){
                                    $(".csrf_token").val(response.csrf_token);
                                    //reinitialsedata();
                                    dataTable.ajax.reload( null, false ); 
                                }else{
                                    $(".csrf_token").val(response.csrf_token);
                                     dataTable.ajax.reload( null, false ); 
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               console.log();
                            }
                        });
            }


                    function showfeature(id,status,pid){
                       var postdata = { id : id,status : status,pid:pid,"<?= $this->security->get_csrf_token_name();?>":$(".csrf_token").val() } ;
                        //console.log( postdata );
                        $.ajax({                        
                            url: "<?=base_url().'master/setpropertyviewstatus'?>",
                            type: "post",
                            data:  postdata ,
                            dataType : 'json',
                            success: function (response) {
                                //console.log(response);
                                if(response == '1'){
                                    //reinitialsedata();
                                    dataTable.ajax.reload( null, false ); 
                                }else{
                                     $(".csrf_token").val(response.csrf_token);
                                     dataTable.ajax.reload( null, false ); 
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               console.log();
                            }
                        });
            }

            function view(id) {
                $('.popup-detail').addClass('intro');
                $.ajax({
                    url :"<?= base_url().'Master/viewDetails';?>",
                    method:"post",
                    data:{
                        id:id,"<?= $this->security->get_csrf_token_name();?>":$(".csrf_token").val()
                    },
                    dataType :"json",
                    success:function(data) {
                        if(data.status ==true) {
                            console.log(data);
                             $(".csrf_token").val(data.csrf_token);
                            $("#viewDetails").html(data.msg);
                        }else {
                             $(".csrf_token").val(data.csrf_token);
                         }
                    }
                });
            }

             function closeD() {
                    $('.popup-detail').removeClass('intro');
            }

        function ownerDetails(id) {
           
            $.ajax({
                url:"<?= base_url().'master/ownerDetails';?>",
                method:"post",
                data:{
                    id:id,"<?= $this->security->get_csrf_token_name();?>":$(".csrf_token").val()
                },
                dataType:"json",
                success:function(data) {
                    if(data.status==true) {
                        $("#owner").html(data.msg);
                         $("#myModal").modal('show');
                          $(".csrf_token").val(response.csrf_token);
                    }
                    else if(data.status ==false) {
                         $(".csrf_token").val(response.csrf_token);
                    }
                }
            });
        }
</script>

