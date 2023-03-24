<?= $header;?>
<div id="preloader"></div>
       <section style="margin:90px 0px">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"></div>
                   <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

                  <div class="card">
                        <div class="card-body">
                          <h3>Subscription List</h3>
                        <hr>
                        <?php
                          if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                          }
                        ?>
                            <div class="card-tools" style="margin-bottom: 60px">
                            <a class="btn btn-success" href="<?= base_url().'admin/addsubscription';?>" style="float: right;margin-bottom: 20px"><i class="fa fa-plus"></i> Add</a>
                            </div>
                            
                            <table id="category_table" class="table display table-bordered table-striped no-wrap" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Action</th>
                    <th>Type</th>
                                        <th>Title</th>
                                        <th>Price</th>                                        
                                        <th>Month Validity</th>                                        
                                        <th>Number of Properties</th>                                        
                                        <th>Number of Pictures</th>                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            
                        </div>
                    </div>
                   </div>
                   <div class="clearfix"></div>
               </div>
           </div>
       </section>


<?= $footer;?>
 
        
<script type="text/javascript">
 var dataTable, edit_data;
            function initialiseData(){
                dataTable = $('#category_table').DataTable({  
                    "processing":true,  
                    "serverSide":true,  
                    "searching": true,
                    "order":[],  
                    "ajax":{  
                        url:"<?=base_url().'admin/getSubscriptionlist'?>",  
                        type:"POST",
                        data: function(d){
                            //d.form = $("#searchForm").serializeArray();
                        },
                        error: function(){  // error handling
                            $(".user_data-error").html("");
                            $("#user_data").append('<tbody class="user_data-error"><tr><th colspan="5">No data found in the server</th></tr></tbody>');
                            $("#user_data_processing").css("display","none");
                        }
                    },"columnDefs":[  
                        {  
                            "targets":[2],  
                            "orderable":false,  
                        },  
                    ],'rowCallback': function(row, data, index){
                        //$(row).find('td:eq(3)').css('background-color', data[3]).html("");   
                    }
                }); 
            }
            initialiseData();

             function updateStatus(id,status){
                switch(status){
                    case 0 : var msg="Are you sure,you want to active ?";break;
                    case 2 : var msg="Are you sure,you want to delete ?";break;
                    case -1 : var msg="Are you sure,you want to deactive ?";break;
                    default : var msg=""; break;
                }
               
                   if(confirm(msg)) {
                       var postdata = { id : id,status : status } ;
                        //console.log( postdata );
                        $.ajax({                        
                            url: "<?=base_url().'admin/setSubscribeStatus'?>",
                            type: "post",
                            data:  postdata ,
                            dataType : 'json',
                            success: function (response) {
                                //console.log(response);
                                if(response == '1'){
                                    //reinitialsedata();
                                    dataTable.ajax.reload( null, false ); 
                                }else{
                                    
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               console.log();
                            }
                        });
                   }
                       
              
            }
</script>