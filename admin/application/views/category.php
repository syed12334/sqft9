<?= $header;?>
      <div class="container-fluid" id="content">

                 <div class="row">
                                                   
<div class="col-xs-12 col-sm-3 col-lg-3">
                        
                                </div>

                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" style="margin-top: 50px">
                      <table id="example2" class="table table-bordered table-hover data-tables"
                               data-options='{ "paging": false; "searching":false}'>
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                             
                            </tbody>
                         
                        </table>
                </div>
                            
</div>

                


                </div>

<?= $footer?>
<script type="text/javascript">
       var dataTable, edit_data;
            function initialiseData(){
                
                dataTable = $('#coupon_table').DataTable({  
                    "processing":true,  
                    "serverSide":true,  
                    "searching": true,
                    "order":[],  
                    "ajax":{  
                        url:"<?=base_url().'master/getCategory'?>",  
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

</script>