<?= $header;?>
        <section style="margin:60px 0px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
               
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                    
                        <div class="my-properties">
                            <h3>Contact List</h3>
                          <?php
                            if(count($owner) >0) {
                                ?>
                                    <table class="table-responsive" id="category_table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Title</th>
                                        <th>Owner Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                            $i=1;
                                            foreach ($owner as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?= $i++;?></td>
                                                    <td><a href="<?= base_url().'propertydetails/'.$value->slug; ?>" title='View Property'><?= $value->title; ?></a></td>
                                                    <td><?= $value->oname; ?></td>
                                                    <td><?= $value->oemail; ?></td>
                                                    <td><?= $value->ophone; ?></td>
                                                </tr>
                                                <?php
                                            }
                                     
                                    ?>
                                </tbody>
                            </table>
                                <?php

                            }else {
                                echo "<h3>Zero Contacts</h3>";
                            }
                          ?>

                             
                        
                        
                        </div>
                    </div>

                
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

       <?= $footer?>



<script type="text/javascript">

</script>
