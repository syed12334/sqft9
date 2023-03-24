<?= $header;?>
<div class="page has-sidebar-left bg-light height-full">
 <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-4">
                    <div class="">
                           <div class="headerview">
                               <h3>Subscriptions</h3>
                               <h5><?php if(!empty($packages)) {echo count($packages); } ?></h5>
                           </div>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="">
                           <div class="headerview1">
                               <h3>Property Category</h3>
                               <h5><?php if(!empty($category)) {echo count($category); } ?></h5>
                           </div>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="">
                           <div class="headerview2">
                               <h3>Property Amenity</h3>
                                <h5><?php if(!empty($amenities)) {echo count($amenities); } ?></h5>
                           </div>
                    </div>
            </div>
            <div class="clearfix"></div>

             <div class="col-md-4">
                    <div class="">
                           <div class="headerview3">
                               <h3>Properties</h3>
                               <h5><?php if(!empty($properties)) {echo count($properties); } ?></h5>
                           </div>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="">
                           <div class="headerview4">
                               <h3>Pincodes</h3>
                               <h5><?php if(!empty($packages)) {echo count($packages); } ?></h5>
                           </div>
                    </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?= $footer;?>
