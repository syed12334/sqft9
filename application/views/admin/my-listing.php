<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    
                        <div class="my-properties">
                            <h3>My Properties</h3>
                            <?php
                                if($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                }
                            ?>
                             <a href="<?= base_url().'property/addproperty';?>" class="btn btn-primary" style="float:right;margin-bottom: 20px">Add Property</a>
                             <br /><br /><br />
                            <table class="table-responsive" id="category_table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th class="pl-2">Property Name</th>
                                        <th class="p-0">Property Type</th>
                                        <th>Date</th>
                                        <th>Package Expiry Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                            </table>
                        
                        </div>
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>

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
                        url:"<?=base_url().'property/getProperties'?>",  
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

            function deleteProperty(id) {
                $.ajax({
                    url :"<?= base_url().'property/deleteData'; ?>",
                    method:"post",
                    dataType:"json",
                    data : {
                        id:id,
                         "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
                    },
                    success:function(data) {
                         $(".csrf_token").val(data.csrf_token);
                        dataTable.ajax.reload( null, false ); 
                      
                    }
                });
            }
</script>