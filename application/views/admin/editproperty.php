<?php 
//echo "<pre>";print_r($amenitylist);exit;
$countimg= $picturecount[0]->pictures - count($getImage);
?>
<?= $header?>
<style type="text/css">
.filepond--root  {
    width:500px
}
#cperiod {
  display: none;
}

#atype {
  display: none;
}
.filepond--drop-label {
    color: #4c4e53;
}

.filepond--label-action {
    text-decoration-color: #babdc0;
}

#areaname-error {
  color:red;
}

.filepond--panel-root {
    border-radius: 2em;
    background-color: #edf0f4;
    height: 1em;
}

#title-error {
    color:red;
}
#rtype-error {
    color:red;
}
#ptype-error {
    color:red;
}

#face-error {
    color:red;
}
#package-error {
  color:red;
}
#house {
    display: none
}

#commercial {
    display: none
}

#shop {
    display: none;
}

#building {
    display: none;
}
#bitype1 {
    display: none
}
#bucommercial {
    display: none
}
#buresidential {
    display: none
}
#uploadVideo {
  display: none;
}

#ylink {
  display: none;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>
        <!-- START SECTION USER PROFILE -->
        <section>
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-3 col-lg-3 col-xs-3"></div>
                    <div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">
                       
                        <div class="col-md-12">
                           <?php
                            if(!$this->session->flashdata('message')) {
                              echo $this->session->flashdata('message');
                            }
                          ?>
                       
                                                                <form action="<?= base_url().'property/saveeditProperty';?>" id="formData" method="post" enctype="multipart/form-data">
                                                                   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                              <input type="hidden" name="ppid" value="<?= $getProperty[0]->id;?>">
                        <div class="single-add-property">
                            <h3>Property description</h3>
                            <div class="property-form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Property Title</label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter your property title" value="<?php echo $getProperty[0]->title; ?>">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Package</label>
                                               <select id="package" name="package" class="form-control">
                                                   <option value="">Select Package</option>
                                                   <?php
                                                    if(count($getPicture) >0) {
                                                        foreach ($getPicture as $key => $value) {
                                                           $pid = $value->pid;
                                                           $getPackage = $this->master_db->getRecords('packages',['id'=>$pid,'formdisplay!='=>1],'title,id,pprice');
                                                           //echo $this->db->last_query();
                                                           if(!empty($getPackage)) {
                                                                ?>
                                                           <option value="<?= $getPackage[0]->id;?>" <?php if($getProperty[0]->pid==$pid){echo "selected";} ?>><?= $getPackage[0]->title." - Rs.".$getPackage[0]->pprice;?></option>
                                                           <?php
                                                           }
                                                        }
                                                    }
                                                   ?>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                         <div class="col-md-4">
                                                <label for="title">Property Type</label>
                                               <select name="ptype" class="form-control" id="ptype">
                                                   <option value="">Select Property Type</option>
                                                   <?php 
                                                    if(count($category)) {
                                                        foreach ($category as $key => $value) {
                                                          $ppid = $value->id;
                                                            ?>
                                                            <option value="<?= $value->id;?>" <?php if($getProperty[0]->ptype==$ppid) {echo "selected";} ?>><?= $value->name;?></option>
                                                            <?php
                                                        }
                                                    }
                                                   ?>
                                               </select>
                                                   <br /><br /> 
                                               <div id="atype" style="<?php if($getProperty[0]->ptype=='1') {echo 'display: block!important';} ?>">
                                                <div class="form-group">
                                                  <label for="face">Apartment Type</label>
                                               <select name="atype" id="atype" class="form-control" style="width:100%!important">
                                                   <option value="">Select Type</option>
                                                   <option value="1" <?php if($getProperty[0]->atype==1) { echo "selected";} ?>>Stand Alone Building</option>
                                                   <option value="2" <?php if($getProperty[0]->atype==2) { echo "selected";} ?>>Mid Society</option>
                                                   <option value="3" <?php if($getProperty[0]->atype==3) { echo "selected";} ?>>Gated Society</option>
                                                   <option value="4" <?php if($getProperty[0]->atype==4) { echo "selected";} ?>>Branded Society</option>
                                                  
                                               </select>
                                             </div>
                                               </div>
                                        </div>

                                              <div class="col-md-4" >
                                            
                                                <label for="face">Facing</label>
                                               <select name="face" class="form-control" id="face">
                                                   <option value="">Select Facing</option>
                                                   <option value="North" <?php if($getProperty[0]->face=="North") {echo "selected";} ?>>North</option>
                                                   <option value="South" <?php if($getProperty[0]->face=="South") {echo "selected";} ?>>South</option>
                                                   <option value="East" <?php if($getProperty[0]->face=="East") {echo "selected";} ?>>East</option>
                                                   <option value="West" <?php if($getProperty[0]->face=="West") {echo "selected";} ?>>West</option>
                                                  
                                               </select>
                                        
                                        </div>
                                        <div class="col-md-4">
                                            

                                             <label for="face">Member Role</label>
                                               <select name="ownerrole" class="form-control" id="ownerrole">
                                                   <option value="">Select Role</option>
                                                   <option value="1" <?php if($getProperty[0]->ownerrole==1) {echo "selected";} ?>>Individual / Direct owner</option>
                                                   <option value="2" <?php if($getProperty[0]->ownerrole==2) {echo "selected";} ?>>Broker</option>
                                                   <option value="3" <?php if($getProperty[0]->ownerrole==3) {echo "selected";} ?>>Builder / Developer</option>
                                                  
                                               </select>
                                                   <br /> 
                                               <div id="cperiod" style="<?php if($getProperty[0]->ownerrole==2) { echo 'display: block!important'; }?>">
                                                  <label for="face">Commission period</label>
                                               <select name="cperoid" class="form-control" >
                                                   <option value="">Select</option>
                                                   <option value="1" <?php if($getProperty[0]->cperiod==1) {echo "selected"; }?>>15 Days</option>
                                                   <option value="2" <?php if($getProperty[0]->cperiod==2) {echo "selected"; }?>>1 Month</option>
                                                   <option value="3" <?php if($getProperty[0]->cperiod==3) {echo "selected"; }?>>No Commission</option>
                                                  
                                               </select>
                                               </div>
                                      
                                        </div> <div class="col-md-4" style="margin:35px 0px 0px 0px">
                                            

                                        </div>

                                         <div class="col-md-4" id="bitype1" style="margin:20px 0px">
                                           <label>Select type</label>
                                           <select id="bitype" name="bitype" class="form-control">
                                               <option value="">Select type</option>
                                               <option value="1" <?php if($getProperty[0]->bitype==1) {echo "selected";} ?>>Commercial</option>
                                               <option value="2" <?php if($getProperty[0]->bitype==2) {echo "selected";} ?>>Residential</option>
                                           </select>

                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-md-12">
                                            <p>
                                                <label for="description">Property Description</label>
                                                <textarea id="description" name="prodesc" placeholder="Describe about your property" class="propertyhighlights"><?php echo $getProperty[0]->prodesc; ?></textarea>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div id="apartment" style="<?php if($getProperty[0]->ptype ==1) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
                                            <div class="row">
                                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                               

                                                    <select name="bed[]" id="bed1" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1" <?php if($getProperty[0]->bedrooms ==1) {echo "selected";}?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->bedrooms ==2) {echo "selected";}?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->bedrooms ==3) {echo "selected";}?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->bedrooms ==4) {echo "selected";}?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->bedrooms ==5) {echo "selected";}?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->bedrooms ==6) {echo "selected";}?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->bedrooms ==7) {echo "selected";}?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->bedrooms ==8) {echo "selected";}?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->bedrooms ==9) {echo "selected";}?>>9</option>
                                               <option value="10" <?php if($getProperty[0]->bedrooms ==10) {echo "selected";}?>>10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                 

                                                     <select name="bath[]" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==1) {echo "selected";} }?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==2) {echo "selected";} }?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==3) {echo "selected";} }?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==4) {echo "selected";} }?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==5) {echo "selected";} }?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==6) {echo "selected";} }?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==7) {echo "selected";} }?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==8) {echo "selected";} }?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==9) {echo "selected";} }?>>9</option>
                                               <option value="10" <?php if($getProperty[0]->ptype ==1) { if($getProperty[0]->bathrooms ==10) {echo "selected";} }?>>10</option>
                                           </select>
                                                </div>
                                            </div>
                                    
                
                
                                     <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                          <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 3200" value="<?php if($getProperty[0]->ptype ==1) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area; }}else {echo '';}?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail[]" id="avail">
                                                       <option value="">Select Availability</option>
                                                       <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Immediate') {echo 'Immediate';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Immediate') {echo 'selected';}}else {echo '';} ?>>Immediate</option>
                                                       <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Within 1 Month') {echo 'Within 1 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Within 1 Month') {echo "selected";}}else {echo '';} ?>>Within 1 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='After One Month') {echo 'After One Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='After One Month') {echo "selected";}}else {echo '';} ?>>After One Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Within 3 Month') {echo 'Within 3 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='Within 3 Month') {echo "selected";}}else {echo '';} ?>>Within 3 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='After Three Month') {echo 'After Three Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->availability=='After Three Month') {echo "selected";}}else {echo '';} ?>>After Three Month</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                  
                                                   <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Available') {echo 'Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Covered') {echo "selected";}}else {echo '';} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->carpark=='Un Available') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                 <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="price1">
                                                <label for="price">Price</label>
                                                <input type="number" name="price[]" placeholder="Eg: 1" class="form-control" id="price" value="<?php if($getProperty[0]->ptype ==1) {if(!empty($getProperty[0]->price)) {echo $getProperty[0]->price; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                     


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                              
                                                 <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==1) {echo "selected";} }?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==2) {echo "selected";} }?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==3) {echo "selected";} }?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==4) {echo "selected";} }?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==5) {echo "selected";} } ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==6) {echo "selected";} } ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==7) {echo "selected";} } ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==8) {echo "selected";} } ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==9) {echo "selected";} } ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==10) {echo "selected";} } ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==11) {echo "selected";} } ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==12) {echo "selected";} } ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==13) {echo "selected";} } ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==14) {echo "selected";} } ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==15) {echo "selected";}} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==16) {echo "selected";}} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==17) {echo "selected";}} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==18) {echo "selected";}} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==19) {echo "selected";}} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==20) {echo "selected";}} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==21) {echo "selected";}} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==22) {echo "selected";}} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==23) {echo "selected";}} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==24) {echo "selected";}} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==25) {echo "selected";} }?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==26) {echo "selected";}} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==27) {echo "selected";}} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==28) {echo "selected";}} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==29) {echo "selected";}} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==30) {echo "selected";} }?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==31) {echo "selected";} }?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==32) {echo "selected";}} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==33) {echo "selected";} }?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==34) {echo "selected";}} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==35) {echo "selected";}} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==36) {echo "selected";}} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==37) {echo "selected";}} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==38) {echo "selected";}} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==39) {echo "selected";}} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==40) {echo "selected";}} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==41) {echo "selected";} }?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==42) {echo "selected";} }?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==43) {echo "selected";} }?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==44) {echo "selected";} }?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==45) {echo "selected";} }?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==46) {echo "selected";} }?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==47) {echo "selected";} }?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==48) {echo "selected";} }?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==49) {echo "selected";} }?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->ptype ==1) {if($getProperty[0]->floors ==50) {echo "selected";} }?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>
                                    

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}else {echo '';} ?>>Furnished</option>
                                                      <option value="<?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}else {echo '';} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>
                                            </div>  
                                        </div>

<div id="house" style="<?php if($getProperty[0]->ptype ==2) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
       <div class="row">
                                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                               

                                                   <select name="bed[]" id="bed2" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==1) {echo "selected";} } ?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==2) {echo "selected";} } ?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==3) {echo "selected";} } ?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==4) {echo "selected";} } ?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==5) {echo "selected";} } ?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==6) {echo "selected";} } ?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==7) {echo "selected";} } ?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==8) {echo "selected";} } ?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==9) {echo "selected";} } ?>>9</option>
                                               <option value="10" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bedrooms ==10) {echo "selected"; } }?>>10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                
                                                     <select name="bath[]" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==1) {echo "selected";}}?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==2) {echo "selected";}}?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==3) {echo "selected";}}?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==4) {echo "selected";}}?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==5) {echo "selected";}}?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==6) {echo "selected";}}?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==7) {echo "selected";}}?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==8) {echo "selected";}}?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==9) {echo "selected";}}?>>9</option>
                                               <option value="10"<?php if($getProperty[0]->ptype ==2) { if($getProperty[0]->bathrooms ==10) {echo "selected";}}?>>10</option>
                                           </select>
                                                </div>
                                            </div>
                                    
                
                
                                     <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                    <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 1" value="<?php if($getProperty[0]->ptype ==2) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area; }}else {echo '';}?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail[]" id="avail">
                                                         <option value="">Select Availability</option>
                                                       

                                                    <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Immediate') {echo 'Immediate';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Immediate') {echo 'selected';}}else {echo '';} ?>>Immediate</option>
                                                       <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Within 1 Month') {echo 'Within 1 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Within 1 Month') {echo "selected";}}else {echo '';} ?>>Within 1 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='After One Month') {echo 'After One Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='After One Month') {echo "selected";}}else {echo '';} ?>>After One Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Within 3 Month') {echo 'Within 3 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='Within 3 Month') {echo "selected";}}else {echo '';} ?>>Within 3 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='After Three Month') {echo 'After Three Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->availability=='After Three Month') {echo "selected";}}else {echo '';} ?>>After Three Month</option>
                                        
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                    

                                                      <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Available') {echo 'Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Covered') {echo "selected";}}else {echo '';} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->carpark=='Un Available') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                 <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="price1">
                                                <label for="price">Price</label>
                                                <input type="number" name="price[]" placeholder="Eg: 2000" class="form-control" id="price" value="<?php if($getProperty[0]->ptype ==2) {if(!empty($getProperty[0]->price)) {echo $getProperty[0]->price; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                     


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                              

                                                             <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==1) {echo "selected";} }?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==2) {echo "selected";} }?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==3) {echo "selected";} }?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==4) {echo "selected";} }?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==5) {echo "selected";} } ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==6) {echo "selected";} } ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==7) {echo "selected";} } ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==8) {echo "selected";} } ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==9) {echo "selected";} } ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==10) {echo "selected";} } ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==11) {echo "selected";} } ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==12) {echo "selected";} } ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==13) {echo "selected";} } ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==14) {echo "selected";} } ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==15) {echo "selected";}} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==16) {echo "selected";}} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==17) {echo "selected";}} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==18) {echo "selected";}} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==19) {echo "selected";}} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==20) {echo "selected";}} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==21) {echo "selected";}} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==22) {echo "selected";}} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==23) {echo "selected";}} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==24) {echo "selected";}} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==25) {echo "selected";} }?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==26) {echo "selected";}} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==27) {echo "selected";}} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==28) {echo "selected";}} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==29) {echo "selected";}} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==30) {echo "selected";} }?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==31) {echo "selected";} }?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==32) {echo "selected";}} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==33) {echo "selected";} }?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==34) {echo "selected";}} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==35) {echo "selected";}} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==36) {echo "selected";}} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==37) {echo "selected";}} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==38) {echo "selected";}} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==39) {echo "selected";}} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==40) {echo "selected";}} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==41) {echo "selected";} }?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==42) {echo "selected";} }?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==43) {echo "selected";} }?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==44) {echo "selected";} }?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==45) {echo "selected";} }?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==46) {echo "selected";} }?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==47) {echo "selected";} }?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==48) {echo "selected";} }?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==49) {echo "selected";} }?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->ptype ==2) {if($getProperty[0]->floors ==50) {echo "selected";} }?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>
                                    

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}else {echo '';} ?>>Furnished</option>
                                                      <option value="<?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}else {echo '';} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>
                                                <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="balcony1">
                                                <label for="price">Balcony</label>
                                                <input type="number" name="balcony[]" placeholder="Eg: 1" class="form-control" id="balcony" value="<?php if($getProperty[0]->ptype ==2) {if(!empty($getProperty[0]->balcony)) {echo $getProperty[0]->balcony; }}else {echo '';}?>">
                                            </div>
                                        </div>
</div>
</div>

                             <div id="commercial" style="<?php if($getProperty[0]->ptype ==4) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
                                 <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="washroom1">
                                                <label for="price">Washroom</label>
                                                <input type="number" name="washroom[]" placeholder="Eg: 1" class="form-control" id="washroom" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->washroom)) {echo $getProperty[0]->washroom; }}else {echo '';}?>">
                                            </div>
                                        </div>
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">LEED Certification</label>
                                                <input type="text" name="leedcertificate[]" placeholder="Enter LEED Certification" class="form-control" id="leedcertificate" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->leedcertificate)) {echo $getProperty[0]->leedcertificate; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="cornerproperty1">
                                                <label for="cornerproperty">Corner Property</label>
                                                <input type="text" name="cornerproperty[]" placeholder="Enter Corner Property" class="form-control" id="cornerproperty" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->cornerproperty)) {echo $getProperty[0]->cornerproperty; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking[]" placeholder="Overlooking" class="form-control" id="overlooking" value="<<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->overlooking)) {echo $getProperty[0]->overlooking; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                      <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 1" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area; }}else {echo '';}?>">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                           <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==1) {echo "selected";} }?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==2) {echo "selected";} }?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==3) {echo "selected";} }?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==4) {echo "selected";} }?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==5) {echo "selected";} } ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==6) {echo "selected";} } ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==7) {echo "selected";} } ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==8) {echo "selected";} } ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==9) {echo "selected";} } ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==10) {echo "selected";} } ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==11) {echo "selected";} } ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==12) {echo "selected";} } ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==13) {echo "selected";} } ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==14) {echo "selected";} } ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==15) {echo "selected";}} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==16) {echo "selected";}} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==17) {echo "selected";}} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==18) {echo "selected";}} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==19) {echo "selected";}} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==20) {echo "selected";}} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==21) {echo "selected";}} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==22) {echo "selected";}} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==23) {echo "selected";}} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==24) {echo "selected";}} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==25) {echo "selected";} }?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==26) {echo "selected";}} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==27) {echo "selected";}} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==28) {echo "selected";}} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==29) {echo "selected";}} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==30) {echo "selected";} }?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==31) {echo "selected";} }?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==32) {echo "selected";}} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==33) {echo "selected";} }?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==34) {echo "selected";}} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==35) {echo "selected";}} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==36) {echo "selected";}} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==37) {echo "selected";}} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==38) {echo "selected";}} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==39) {echo "selected";}} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==40) {echo "selected";}} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==41) {echo "selected";} }?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==42) {echo "selected";} }?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==43) {echo "selected";} }?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==44) {echo "selected";} }?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==45) {echo "selected";} }?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==46) {echo "selected";} }?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==47) {echo "selected";} }?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==48) {echo "selected";} }?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==49) {echo "selected";} }?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==50) {echo "selected";} }?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Available') {echo 'Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}else {echo '';} ?>>Furnished</option>
                                                      <option value="<?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}else {echo '';} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod[]" placeholder="Eg: 10" class="form-control" id="lockperiod" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->lockperiod)) {echo $getProperty[0]->lockperiod; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                  
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                   

                                                      <option value="<?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Available') {echo 'Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Covered') {echo "selected";}}else {echo '';} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->carpark=='Un Available') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass[]" id="buildingclass" class="form-control" placeholder="Building class" value="<?php if($getProperty[0]->ptype ==4) {if(!empty($getProperty[0]->buildingclass)) {echo $getProperty[0]->buildingclass; }}else {echo '';}?>">
                                                </div>
                                            </div>
                                 </div>
                             </div>           

                                         <div id="plot" style="<?php if($getProperty[0]->ptype ==5) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
 <div class="row">
                                         
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">Project Name</label>
                                                <input type="text" name="projectname" placeholder="Enter Project Name" class="form-control" id="projectname" value="<?php if($getProperty[0]->ptype ==5) {if(!empty($getProperty[0]->pname)) {echo $getProperty[0]->pname; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="cornerproperty1">
                                                <label for="cornerproperty">Status of Electricity</label>
                                                <select name="electricity" id="electricity" class="form-control">
                                                    <option value="">Select Option</option>
                                                    <option value="No"  
<?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->electricity=='No') {echo "selected";}}else {echo '';} ?>>No</option>
                                                    <option value="Rare Powercut" 
<?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->electricity=='Rare Powercut') {echo "selected";}}else {echo '';} ?>>Rare Powercut</option>
                                                </select>
                                            </div>
                                        </div>


                                        

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Select Option</label>
                                                
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available" <?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Available</option>
                                                     <option value="Un Available" <?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->carpark=='Un Available') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Transaction Type</label>
                                                      <select name="ttype" id="ttype" class="form-control">
                                                    <option value="">Select Option</option>
                                                    <option value="New Property" <?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->ttype=='New Property') {echo "selected";}}else {echo '';} ?>>New Property</option>
                                                    <option value="Free Legal Title Check" <?php if($getProperty[0]->ptype ==5) {if($getProperty[0]->ttype=='Free Legal Title Check') {echo "selected";}}else {echo '';} ?>>Free Legal Title Check</option>
                                                </select>
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass1" id="buildingclass" class="form-control" placeholder="Building class" value="<?php if($getProperty[0]->ptype ==5) {if(!empty($getProperty[0]->buildingclass)) {echo $getProperty[0]->buildingclass; }}else {echo '';}?>">
                                                </div>
                                            </div>


                                             <div class="col-lg-12 col-md-12">
                                            <div class="form-group" id="propertyhighlights1">
                                                <label>Property Highlights</label>
                                                <textarea name="highlights" class="form-control propertyhighlights" id="propertyhighlights"><?php if($getProperty[0]->ptype ==5) {if(!empty($getProperty[0]->prohights)) {echo $getProperty[0]->prohights; }}else {echo '';}?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        </div>

                                         <div id="bucommercial" style="<?php if($getProperty[0]->ptype ==4) { if($getProperty[0]->bitype ==1) {echo 'display:block!important';}else {echo 'display:none!important';}}else {echo 'display:none!important';} ?>">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                          <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 3200" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area;}}else {echo '';}}?>">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                                   <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==1) {echo "selected";} }?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==2) {echo "selected";} }?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==3) {echo "selected";} }?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==4) {echo "selected";} }?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==5) {echo "selected";} } ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==6) {echo "selected";} } ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==7) {echo "selected";} } ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==8) {echo "selected";} } ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==9) {echo "selected";} } ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==10) {echo "selected";} } ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==11) {echo "selected";} } ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==12) {echo "selected";} } ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==13) {echo "selected";} } ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==14) {echo "selected";} } ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==15) {echo "selected";}} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==16) {echo "selected";}} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==17) {echo "selected";}} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==18) {echo "selected";}} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==19) {echo "selected";}} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==20) {echo "selected";}} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==21) {echo "selected";}} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==22) {echo "selected";}} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==23) {echo "selected";}} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==24) {echo "selected";}} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==25) {echo "selected";} }?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==26) {echo "selected";}} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==27) {echo "selected";}} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==28) {echo "selected";}} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==29) {echo "selected";}} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==30) {echo "selected";} }?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==31) {echo "selected";} }?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==32) {echo "selected";}} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==33) {echo "selected";} }?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==34) {echo "selected";}} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==35) {echo "selected";}} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==36) {echo "selected";}} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==37) {echo "selected";}} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==38) {echo "selected";}} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==39) {echo "selected";}} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==40) {echo "selected";}} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==41) {echo "selected";} }?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==42) {echo "selected";} }?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==43) {echo "selected";} }?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==44) {echo "selected";} }?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==45) {echo "selected";} }?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==46) {echo "selected";} }?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==47) {echo "selected";} }?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==48) {echo "selected";} }?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==49) {echo "selected";} }?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->ptype ==4) {if($getProperty[0]->floors ==50) {echo "selected";} }?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="washroom1">
                                                <label for="price">Washroom</label>
                                                <input type="number" name="washroom[]" placeholder="Eg: 1" class="form-control" id="washroom" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->washroom)) {echo $getProperty[0]->washroom;}}else {echo '';}}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking[]" placeholder="Overlooking" class="form-control" id="overlooking" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->overlooking)) {echo $getProperty[0]->overlooking;}}else {echo '';}}?>">
                                            </div>
                                        </div>


                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod[]" placeholder="Enter Lock in Period" class="form-control" id="lockperiod" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->lockperiod)) {echo $getProperty[0]->lockperiod;}}else {echo '';}}?>">
                                            </div>
                                        </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass[]" id="buildingclass" class="form-control" placeholder="Building class" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->buildingclass)) {echo $getProperty[0]->buildingclass;}}else {echo '';}}?>">
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Available') {echo 'Available';}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Available') {echo "selected";}}} ?>>Available</option>
                                                      <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Covered') {echo "Covered";}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Covered') {echo "selected";}}} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Un Available') {echo "Un Available";}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==1) {if($getProperty[0]->availability=='Un Available') {echo "selected";}}} ?>>Un Available</option>



                                                   </select>
                                                </div>
                                            </div>

                                        

                                               <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="cornerproperty1">
                                                <label for="cornerproperty">Corner Property</label>
                                                <input type="text" name="cornerproperty[]" placeholder="Enter Maintenance Charges" class="form-control" id="cornerproperty" value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->cornerproperty)) {echo $getProperty[0]->cornerproperty;}}else {echo '';}}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished'){if($getProperty[0]->bitype ==1) {if($getProperty[0]->furnished=='Furnished') {echo 'Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Furnished'){if($getProperty[0]->bitype ==1) {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}} ?>>Furnished</option>
                                                      <option value="<?php if($getProperty[0]->furnished =='Semi Furnished'){if($getProperty[0]->bitype ==1) {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished'){if($getProperty[0]->bitype ==1) {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Un Furnished'){if($getProperty[0]->bitype ==1) {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>  

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">LEED Certification</label>
                                                <input type="text" name="leedcertificate[]" placeholder="Enter LEED Certification" class="form-control" id="leedcertificate" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->leedcertificate)) {echo $getProperty[0]->leedcertificate;}}else {echo '';}}?>>
                                            </div>
                                        </div>
                                            </div>
                                        </div>

                                         <div id="buresidential" style="<?php if($getProperty[0]->ptype ==4) { if($getProperty[0]->bitype ==2) {echo 'display:block!important';}else {echo 'display:none!important';}}else {echo 'display:none!important';} ?>">
                                            <div class="row">
                                                
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="balcony1">
                                                <label for="price">Balcony</label>
                                                <input type="number" name="balcony[]" placeholder="Eg: 1" class="form-control" id="balcony"   value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==1) {if(!empty($getProperty[0]->balcony)) {echo $getProperty[0]->balcony;}}else {echo '';}}?>">
                                            </div>
                                        </div>



 <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail[]" id="avail">
                                                      

                                                         <option value="">Select Availability</option>
                                                       
                                                        <option value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Immediate') {echo 'Immediate';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Immediate') {echo 'selected';}}else {echo '';} ?>>Immediate</option>
                                                       <option value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Within 1 Month') {echo 'Within 1 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Within 1 Month') {echo "selected";}}else {echo '';} ?>>Within 1 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='After One Month') {echo 'After One Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='After One Month') {echo "selected";}}else {echo '';} ?>>After One Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Within 3 Month') {echo 'Within 3 Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='Within 3 Month') {echo "selected";}}else {echo '';} ?>>Within 3 Month</option>
                                                        <option value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='After Three Month') {echo 'After Three Month';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->availability=='After Three Month') {echo "selected";}}else {echo '';} ?>>After Three Month</option>
                                                   </select>
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                                

                                                   <select name="bed[]" id="bed" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1" <?php if($getProperty[0]->bedrooms ==1) {echo "selected";}?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->bedrooms ==2) {echo "selected";}?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->bedrooms ==3) {echo "selected";}?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->bedrooms ==4) {echo "selected";}?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->bedrooms ==5) {echo "selected";}?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->bedrooms ==6) {echo "selected";}?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->bedrooms ==7) {echo "selected";}?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->bedrooms ==8) {echo "selected";}?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->bedrooms ==9) {echo "selected";}?>>9</option>
                                               <option value="10" <?php if($getProperty[0]->bedrooms ==10) {echo "selected";}?>>10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                  
                                                     <select name="bath[]" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1" <?php if($getProperty[0]->bathrooms ==1) {echo "selected";}?>>1</option>
                                               <option value="2" <?php if($getProperty[0]->bathrooms ==2) {echo "selected";}?>>2</option>
                                               <option value="3" <?php if($getProperty[0]->bathrooms ==3) {echo "selected";}?>>3</option>
                                               <option value="4" <?php if($getProperty[0]->bathrooms ==4) {echo "selected";}?>>4</option>
                                               <option value="5" <?php if($getProperty[0]->bathrooms ==5) {echo "selected";}?>>5</option>
                                               <option value="6" <?php if($getProperty[0]->bathrooms ==6) {echo "selected";}?>>6</option>
                                               <option value="7" <?php if($getProperty[0]->bathrooms ==7) {echo "selected";}?>>7</option>
                                               <option value="8" <?php if($getProperty[0]->bathrooms ==8) {echo "selected";}?>>8</option>
                                               <option value="9" <?php if($getProperty[0]->bathrooms ==9) {echo "selected";}?>>9</option>
                                               <option value="10" <?php if($getProperty[0]->bathrooms ==10) {echo "selected";}?>>10</option>
                                           </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished'){if($getProperty[0]->bitype ==2) {if($getProperty[0]->furnished=='Furnished') {echo 'Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Furnished'){if($getProperty[0]->bitype ==2) {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}} ?>>Furnished</option>
                                                      <option value="<?php if($getProperty[0]->furnished =='Semi Furnished'){if($getProperty[0]->bitype ==2) {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished'){if($getProperty[0]->bitype ==2) {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}} ?>" <?php if($getProperty[0]->furnished =='Un Furnished'){if($getProperty[0]->bitype ==2) {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                      <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 1"  value="<?php if($getProperty[0]->ptype ==7) {if($getProperty[0]->bitype ==2) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area;}}else {echo '';}}?>">
                                                </div>
                                            </div>


                                                <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->carpark=='Available') {echo 'Available';}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->carpark=='Available') {echo "selected";}}} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->availability=='Covered') {echo "selected";}}} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}} ?>" <?php if($getProperty[0]->ptype ==7){if($getProperty[0]->bitype ==2) {if($getProperty[0]->carpark=='Un Available') {echo "selected";}}} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                         <div id="shop" style="<?php if($getProperty[0]->ptype ==6) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
                                            <div class="row">
                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                            <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 1" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area; }}else {echo '';}?>">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                               
                                                 <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->floors ==1) {echo "selected";} ?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->floors ==2) {echo "selected";} ?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->floors ==3) {echo "selected";} ?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->floors ==4) {echo "selected";} ?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->floors ==5) {echo "selected";} ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->floors ==6) {echo "selected";} ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->floors ==7) {echo "selected";} ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->floors ==8) {echo "selected";} ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->floors ==9) {echo "selected";} ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->floors ==10) {echo "selected";} ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->floors ==11) {echo "selected";} ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->floors ==12) {echo "selected";} ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->floors ==13) {echo "selected";} ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->floors ==14) {echo "selected";} ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->floors ==15) {echo "selected";} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->floors ==16) {echo "selected";} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->floors ==17) {echo "selected";} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->floors ==18) {echo "selected";} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->floors ==19) {echo "selected";} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->floors ==20) {echo "selected";} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->floors ==21) {echo "selected";} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->floors ==22) {echo "selected";} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->floors ==23) {echo "selected";} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->floors ==24) {echo "selected";} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->floors ==25) {echo "selected";} ?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->floors ==26) {echo "selected";} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->floors ==27) {echo "selected";} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->floors ==28) {echo "selected";} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->floors ==29) {echo "selected";} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->floors ==30) {echo "selected";} ?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->floors ==31) {echo "selected";} ?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->floors ==32) {echo "selected";} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->floors ==33) {echo "selected";} ?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->floors ==34) {echo "selected";} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->floors ==35) {echo "selected";} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->floors ==36) {echo "selected";} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->floors ==37) {echo "selected";} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->floors ==38) {echo "selected";} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->floors ==39) {echo "selected";} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->floors ==40) {echo "selected";} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->floors ==41) {echo "selected";} ?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->floors ==42) {echo "selected";} ?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->floors ==43) {echo "selected";} ?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->floors ==44) {echo "selected";} ?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->floors ==45) {echo "selected";} ?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->floors ==46) {echo "selected";} ?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->floors ==47) {echo "selected";} ?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->floors ==48) {echo "selected";} ?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->floors ==49) {echo "selected";} ?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->floors ==50) {echo "selected";} ?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking[]" placeholder="Overlooking" class="form-control" id="overlooking" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->overlooking)) {echo $getProperty[0]->overlooking; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="plotarea1">
                                                <label for="price">Plot Area</label>
                                                <input type="number" name="plotarea[]" placeholder="Eg: 3200" class="form-control" id="plotarea" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->plotarea)) {echo $getProperty[0]->plotarea; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="unitofloor1">
                                                <label for="price">Unit of Floor</label>
                                                <input type="number" name="unitofloor[]" placeholder="Eg: 1" class="form-control" id="unitofloor" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->unitoffloor)) {echo $getProperty[0]->unitoffloor; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="number" name="lockperiod[]" placeholder="Eg: 10" class="form-control" id="lockperiod" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->lockperiod)) {echo $getProperty[0]->lockperiod; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="maintenance1">
                                                <label for="price">Maintenance Charges</label>
                                                <input type="number" name="maintenance[]" placeholder="Eg: 3000" class="form-control" id="maintenance" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->maintenancecharge)) {echo $getProperty[0]->maintenancecharge; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Available') {echo 'Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Covered') {echo "selected";}}else {echo '';} ?>>Covered</option>

                                                     <option value="<?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==6) {if($getProperty[0]->carpark=='Available') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>

                                             <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Parking Ratio</label>
                                                   <input type="text" name="parkingratio" id="parkingratio" class="form-control" placeholder="Parking Ratio" value="<?php if($getProperty[0]->ptype ==6) {if(!empty($getProperty[0]->parkingratio)) {echo $getProperty[0]->parkingratio; }}else {echo '';}?>">
                                                </div>
                                            </div>
</div>

                                        </div>                      
                <div id="office" style="<?php if($getProperty[0]->ptype ==3) {echo 'display:block!important';}else {echo 'display:none!important';} ?>">
                    <div class="row">
                      

                                       


                                       

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished[]" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Furnished') {if($getProperty[0]->furnished=='Furnished') {echo 'selected';}}else {echo '';} ?>>Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo 'Semi Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Semi Furnished') {if($getProperty[0]->furnished=='Semi Furnished') {echo "selected";}}else {echo '';} ?>>Semi Furnished</option>
                                                   <option value="<?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo 'Un Furnished';}}else {echo '';} ?>" <?php if($getProperty[0]->furnished =='Un Furnished') {if($getProperty[0]->furnished=='Un Furnished') {echo "selected";}}else {echo '';} ?>>Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                <input type="number" name="area[]" id="area" class="form-control" placeholder="Eg: 1" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->area)) {echo $getProperty[0]->area; }}else {echo '';}?>">
                                                </div>
                                            </div>

                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="carpetarea1">
                                                <label for="price">Carpet Area</label>
                                                <input type="number" name="carpetarea" placeholder="Eg: 500" class="form-control" id="carpetarea" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->carpetarea)) {echo $getProperty[0]->carpetarea; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12" id="loading1">
                                            <div class="form-group" >
                                                <label for="price">Loading</label>
                                                <input type="text" name="loading" placeholder="Enter Loaing in percentage" class="form-control" id="loading" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->loading)) {echo $getProperty[0]->loading; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="plotarea1">
                                                <label for="price">Plot Area</label>
                                                <input type="number" name="plotarea[]" placeholder="Eg: 3200" class="form-control" id="plotarea" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->plotarea)) {echo $getProperty[0]->plotarea; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                            <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                              
                                                 <select name="floors[]"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1"  <?php if($getProperty[0]->floors ==1) {echo "selected";} ?>>1</option>
                                               <option value="2"  <?php if($getProperty[0]->floors ==2) {echo "selected";} ?>>2</option>
                                               <option value="3"  <?php if($getProperty[0]->floors ==3) {echo "selected";} ?>>3</option>
                                               <option value="4"  <?php if($getProperty[0]->floors ==4) {echo "selected";} ?>>4</option>
                                               <option value="5"  <?php if($getProperty[0]->floors ==5) {echo "selected";} ?>>5</option>
                                               <option value="6"  <?php if($getProperty[0]->floors ==6) {echo "selected";} ?>>6</option>
                                               <option value="7"  <?php if($getProperty[0]->floors ==7) {echo "selected";} ?>>7</option>
                                               <option value="8"  <?php if($getProperty[0]->floors ==8) {echo "selected";} ?>>8</option>
                                               <option value="9"  <?php if($getProperty[0]->floors ==9) {echo "selected";} ?>>9</option>
                                               <option value="10"  <?php if($getProperty[0]->floors ==10) {echo "selected";} ?>>10</option>
                                               <option value="11"  <?php if($getProperty[0]->floors ==11) {echo "selected";} ?>>11</option>
                                               <option value="12"  <?php if($getProperty[0]->floors ==12) {echo "selected";} ?>>12</option>
                                               <option value="13"  <?php if($getProperty[0]->floors ==13) {echo "selected";} ?>>13</option>
                                               <option value="14"  <?php if($getProperty[0]->floors ==14) {echo "selected";} ?>>14</option>
                                               <option value="15"  <?php if($getProperty[0]->floors ==15) {echo "selected";} ?>>15</option>
                                               <option value="16"  <?php if($getProperty[0]->floors ==16) {echo "selected";} ?>>16</option>
                                               <option value="17"  <?php if($getProperty[0]->floors ==17) {echo "selected";} ?>>17</option>
                                               <option value="18"  <?php if($getProperty[0]->floors ==18) {echo "selected";} ?>>18</option>
                                               <option value="19"  <?php if($getProperty[0]->floors ==19) {echo "selected";} ?>>19</option>
                                               <option value="20"  <?php if($getProperty[0]->floors ==20) {echo "selected";} ?>>20</option>
                                               <option value="21"  <?php if($getProperty[0]->floors ==21) {echo "selected";} ?>>21</option>
                                               <option value="22"  <?php if($getProperty[0]->floors ==22) {echo "selected";} ?>>22</option>
                                               <option value="23"  <?php if($getProperty[0]->floors ==23) {echo "selected";} ?>>23</option>
                                               <option value="24"  <?php if($getProperty[0]->floors ==24) {echo "selected";} ?>>24</option>
                                               <option value="25"  <?php if($getProperty[0]->floors ==25) {echo "selected";} ?>>25</option>
                                               <option value="26"  <?php if($getProperty[0]->floors ==26) {echo "selected";} ?>>26</option>
                                               <option value="27"  <?php if($getProperty[0]->floors ==27) {echo "selected";} ?>>27</option>
                                               <option value="28"  <?php if($getProperty[0]->floors ==28) {echo "selected";} ?>>28</option>
                                               <option value="29"  <?php if($getProperty[0]->floors ==29) {echo "selected";} ?>>29</option>
                                               <option value="30"  <?php if($getProperty[0]->floors ==30) {echo "selected";} ?>>30</option>
                                               <option value="31"  <?php if($getProperty[0]->floors ==31) {echo "selected";} ?>>31</option>
                                               <option value="32"  <?php if($getProperty[0]->floors ==32) {echo "selected";} ?>>32</option>
                                               <option value="33"  <?php if($getProperty[0]->floors ==33) {echo "selected";} ?>>33</option>
                                               <option value="34"  <?php if($getProperty[0]->floors ==34) {echo "selected";} ?>>34</option>
                                               <option value="35"  <?php if($getProperty[0]->floors ==35) {echo "selected";} ?>>35</option>
                                               <option value="36"  <?php if($getProperty[0]->floors ==36) {echo "selected";} ?>>36</option>
                                               <option value="37"  <?php if($getProperty[0]->floors ==37) {echo "selected";} ?>>37</option>
                                               <option value="38"  <?php if($getProperty[0]->floors ==38) {echo "selected";} ?>>38</option>
                                               <option value="39"  <?php if($getProperty[0]->floors ==39) {echo "selected";} ?>>39</option>
                                               <option value="40"  <?php if($getProperty[0]->floors ==40) {echo "selected";} ?>>40</option>
                                               <option value="41"  <?php if($getProperty[0]->floors ==41) {echo "selected";} ?>>41</option>
                                               <option value="42"  <?php if($getProperty[0]->floors ==42) {echo "selected";} ?>>42</option>
                                               <option value="43"  <?php if($getProperty[0]->floors ==43) {echo "selected";} ?>>43</option>
                                               <option value="44"  <?php if($getProperty[0]->floors ==44) {echo "selected";} ?>>44</option>
                                               <option value="45"  <?php if($getProperty[0]->floors ==45) {echo "selected";} ?>>45</option>
                                               <option value="46"  <?php if($getProperty[0]->floors ==46) {echo "selected";} ?>>46</option>
                                               <option value="47"  <?php if($getProperty[0]->floors ==47) {echo "selected";} ?>>47</option>
                                               <option value="48"  <?php if($getProperty[0]->floors ==48) {echo "selected";} ?>>48</option>
                                               <option value="49"  <?php if($getProperty[0]->floors ==49) {echo "selected";} ?>>49</option>
                                               <option value="50"  <?php if($getProperty[0]->floors ==50) {echo "selected";} ?>>50</option>
                                             
                                           </select>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="unitofloor1">
                                                <label for="price">Unit of Floor</label>
                                                <input type="number" name="unitofloor[]" placeholder="Eg: 1" class="form-control" id="unitofloor" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->unitoffloor)) {echo $getProperty[0]->unitoffloor; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking[]" placeholder="Overlooking" class="form-control" id="overlooking" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->overlooking)) {echo $getProperty[0]->overlooking; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="number" name="lockperiod[]" placeholder="Eg: 1" class="form-control" id="lockperiod" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->lockperiod)) {echo $getProperty[0]->lockperiod; }}else {echo '';}?>">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark[]" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='Available') {echo 'selected';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='Available') {echo 'selected';}}else {echo '';} ?>>Available</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='Covered') {echo 'Covered';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='Covered') {echo "selected";}}else {echo '';} ?>>Covered</option>
                                                     <option value="<?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='Un Available') {echo 'Un Available';}}else {echo '';} ?>" <?php if($getProperty[0]->ptype ==3) {if($getProperty[0]->carpark=='UnAvailable') {echo "selected";}}else {echo '';} ?>>Un Available</option>
                                                   </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="maintenance1">
                                                <label for="price">Maintenance Charges</label>
                                                <input type="number" name="maintenance[]" placeholder="Eg: 3000" class="form-control" id="maintenance" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->maintenancecharge)) {echo $getProperty[0]->maintenancecharge; }}else {echo '';}?>">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="nooflift1">
                                                <label for="price">Number of Lift</label>
                                                <input type="number" name="nooflift" placeholder="Eg: 1" class="form-control" id="nooflift" value="<?php if($getProperty[0]->ptype ==3) {if(!empty($getProperty[0]->nooflift)) {echo $getProperty[0]->nooflift; }}else {echo '';}?>">
                                            </div>
                                        </div>                
                    </div>
                     
                </div>
                                    </div>
                                 
                              
                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Media</h3>
                            <div class="property-form-group">
                                <div class="row">

                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <p style="margin-bottom: 5px">Upload Property Images, Videos & Floor plan image</p>
                                      <span style="color:red">(Only 5 images are allowed)</span>
                                   </div>
                                   <div class="clearfix"></div>
                                   
                                                     <div class="col-md-5">
                                       
                                       
                                   

                                     <table class="table  table-bordered" id="tablechild" style="margin-top: 10px">
                            <tr>
                              <th width="20%">Gallery Media</th>
                            
                              <th class="text-center" width="5%"><span style="float: left;margin-right:10px">Add</span> <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                            </tr>
                          
                                       <?php
                              if(count($getImage)) {
                                foreach ($getImage as $key => $value) {
                                  ?>
                                     <tr id="row" class="removeGal<?= $value->ppid;?>">
                                      <input type="hidden" name="pimgid[]" value="<?= $value->ppid;?>">
                                        <td><input type="file" name="gallery[]">
                                          <img src="<?= base_url().$value->p_img;?>" style="width:20%" >
                                        </td>
                                        <td class="text-center"><button type="button" onClick="removeppidImg('<?= $value->ppid;?>')" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td>
                                     </tr>
                                  <?php
                                }
                              }
                            ?>
                               
                           
                          </table>

                                    </div>

                                     <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                      <div class="form-group">
                                        <label>Video Type</label>
                                        <select name="vtype" class="form-control" id="vtype">
                                          <option value="">Select Option</option>
                                          <option value="1" <?php if($getProperty[0]->videotype ==1) {echo "selected";}?>>Upload Video</option>
                                          <option value="2" <?php if($getProperty[0]->videotype ==2) {echo "selected";}?>>Youtube Link</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                      <div class="form-group" id="uploadVideo" style="<?php if($getProperty[0]->videotype ==1) {echo 'display: block!important';}?>">
                                        <label>Upload Video</label>
                                        <input type="file" name="uvideo" class="form-control">
                                        <?php

                                        if($getProperty[0]->videotype ==1) {
                                            if(!empty($getProperty[0]->video_path) && $getProperty[0]->video_path !="") {
                                            ?>
                                              <video width="320" height="240" controls>
                                                  <source src="<?= base_url().$getProperty[0]->video_path?>" type="video/mp4">
                                              </video>
                                            <?php
                                          }
                                        } 
                                        ?>
                                   
            
                                      </div>
                                       <div class="form-group" id="ylink" style="<?php if($getProperty[0]->videotype ==2) {echo 'display: block!important';}?>">
                                        <label>Youtube Link</label>
                                        <input type="url" name="ylink" class="form-control" placeholder="Youtube Link" value="<?php if($getProperty[0]->videotype ==2) { echo "https://www.youtube.com/watch?v=".$getProperty[0]->video_path;} ?>">

                                        <?php

                                        if($getProperty[0]->videotype ==2) {
                                            ?>
                                              <iframe width="50%" height="100" src="https://www.youtube.com/embed/<?= $getProperty[0]->video_path;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            <?php
                                        }
                                        ?>
                                      </div>
                                    </div>
                                    <div class="clearfix"></div>
                                      
                                   
                                </div>
                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Location</h3>
                            <div class="property-form-group">
                                <div class="row">
                                   
                                     <div class="col-xs-12 col-sm-4 col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select name="state" id="state" class="form-control">
                                              <option value="">Select State</option>
                                              <?php
                                                if(count($states)) {
                                                  foreach ($states as $state) {
                                                    $id = $state->id;
                                                   ?>
                                                   <option value="<?= $state->id;?>" <?php if($getProperty[0]->pstate == $id) {echo "selected";}?>><?= $state->name;?></option>
                                                   <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select id="city" name="city" class="form-control">
                                              <option>Select city</option>
                                                <?php
                                                if(count($city)) {
                                                  foreach ($city as  $value) {
                                                    $id = $value->id;
                                                    ?>
                                                    <option value="<?= $value->id;?>" <?php if($getProperty[0]->pcity==$id) {echo "selected";}?>><?= $value->cname;?></option>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                        </div>
                                    </div>


                                          <div class="col-xs-12 col-sm-4 col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="city">Area</label>
                                            <select id="areaname" name="areaname" class="form-control">
                                              <option value="">Select Area</option>
                                              <?php
                                                if(count($area)) {
                                                  foreach ($area as  $value) {
                                                    ?>
                                                    <option value="<?= $value->id;?>" <?php if($getProperty[0]->areaid==$value->id) {echo "selected";}?>><?= $value->areaname;?></option>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" placeholder="Enter Your Country" class="form-control" id="country" value="<?php if(!empty($getProperty[0]->pcountry)) {echo $getProperty[0]->pcountry; }?>"  value="India" readonly>
                                        </div>
                                    </div>
                                      <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="maps">Google Maps Iframe</label>
                                            <textarea name="maps" class="form-control" cols="2" rows="2">
                                              <?php if(!empty($getProperty[0]->embedmap)) {echo $getProperty[0]->embedmap; }?>
                                            </textarea>
                                             <span style="color:red">(Visit google maps to generate your location iframe and paste it here)</span>
                                           <div style="width:200px!important;overflow: hidden;height: 200px">
                                             <?php if(!empty($getProperty[0]->embedmap)) {echo $getProperty[0]->embedmap; }?>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                           <div class="form-group">
                                            <label for="maps">Address</label>
                                            <textarea cols="5" rows="5" class="form-control" placeholder="Enter Address" id="address" name="address"><?php if(!empty($getProperty[0]->paddress)) {echo $getProperty[0]->paddress; }?></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="single-add-property">
                            <h3>Amenities</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12" id="amenityview">
                                        <ul class="pro-feature-add pl-0">
                                          <?php
                                            if(count($amenities)) {

                                              foreach ($amenities as $key => $value) {
                                                $aid = $value->id;
                                                
                                                 $getPr = $this->master_db->getRecords('property_amenities',['prid'=>$getProperty[0]->id],'p_amenities as paid,id','id desc','p_amenities');
                                                 //echo $this->db->last_query();exit;
                                               
                                                ?>
                                                     <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                      <input type="hidden" name="aid" value="<?= $value->id; ?>">
                                                        <input id="check-a<?= $value->id;?>" type="checkbox" name="amenities[]" value="<?= $value->id;?>" <?php if(count($getPr)) {foreach($getPr as $key => $prid) {if($prid->paid == $aid) {echo "checked";}}}
                                                        ?>>
                                                        <label for="check-a<?= $value->id;?>"><?= $value->title;?></label>
                                                    </div>
                                                </div>
                                            </li>
                                                <?php
                                              }
                                            }
                                          ?>
                                        
                                        </ul>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                               
                        <div class="single-add-property">
                            <h3>What's Nearby</h3>
                            <div class="property-form-group">
                             
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea id="description" name="nearby" placeholder="Describe about nearby property" class="form-control" cols="4" rows="4"><?php if(!empty($getProperty[0]->nearbyarea)) {echo $getProperty[0]->nearbyarea; }?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                
                
                        <div class="single-add-property">
                            
                            <div class="add-property-button pt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="prperty-submit-button">
                                            <button type="submit" name="submit">Update Property</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
  <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
               <?= $footer?>
               <script type="text/javascript">

                
                  $(document).ready(function () {

                $("#back").on("click",function(e) {
                    e.preventDefault();
                    $('.popup-detail').removeClass('intro');
                });
                $('.open-pop').click(function () {
                    $('.popup-detail').addClass('intro');
                });
                $('.close-d').click(function () {
                    $('.popup-detail').removeClass('intro');
                });
            });

            $(document).ready(function() {

             $("#formData").validate({
            rules: {
                title: "required",
                package: "required",
                ptype: "required",
                ownerrole :"required",
                address:"required",
                city:"required",
                state :"required",
                country :"required",
                areaname:"required"
            },
            messages: {
                title: "Please enter title",
                package: "Please enter package name",
                ptype: "Please select property",
                ownerrole:"Please select owner role",
                address :"Please enter property address",
                city :"Please enter property city",
                state :"Please select state",
                country :"Please enter property country",
                areaname:"Please select areaname"
                           
              }
        });
              
            });

function removeppidImg(id) {
    $.post('<?= base_url().'property/deleteProgallery'; ?>',{id:id, "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()},function(data) {
      if(data.status ==true) {
        $(".removeGal"+id).fadeOut(100);
      }else {

      }
    },'json');
}

$(document).ready(function() {
    $("#ptype").on('change',function(e) {
        //e.preventDefault();
        var id = $(this).val();
        if(id ==1) {
            $("#apartment").show();
            $("#atype").show();

            $("#office").hide();
            $("#plot").hide();
            $("#commercial").hide();
             $("#shop").hide();
            $("#propertyhighlights1").hide();
              $("#buresidential").hide();
            $("#bucommercial").hide();
             $("#bitype1").hide();
        }else if(id ==2) {
               $("#house").show();
                 $("#plot").hide();
            $("#commercial").hide();
               $("#apartment").hide();
                $("#atype").hide();
            $("#office").hide();
             $("#shop").hide();
            $("#propertyhighlights1").hide();
             $("#buresidential").hide();
            $("#bucommercial").hide();
             $("#bitype1").hide();
        }
        else if(id ==3) {
            $("#apartment").hide();
            $("#office").show();
             $("#atype").hide();
              $("#plot").hide();
            $("#commercial").hide();
            $("#house").hide();
            $("#shop").hide();
           $("#buresidential").hide();
            $("#bucommercial").hide();
            $("#propertyhighlights1").hide();
             $("#bitype1").hide();
      
        }
        else if(id ==4) {
             $("#apartment").hide();
            $("#office").hide();
             $("#atype").hide();
            $("#house").hide();
             $("#plot").hide();
            $("#commercial").show();
           $("#shop").hide();
            $("#buresidential").hide();
            $("#bucommercial").hide();
            $("#propertyhighlights1").hide();
             $("#bitype1").hide();
        }
        else if(id ==5) {
            $("#apartment").hide();
            $("#office").hide();
             $("#atype").hide();
            $("#house").hide();
            $("#commercial").hide();
            $("#plot").show();
           $("#buresidential").hide();
            $("#bucommercial").hide();
            $("#propertyhighlights1").show();
             $("#bitype1").hide();
        }
        else if(id ==6) {
             $("#apartment").hide();
            $("#office").hide();
            $("#house").hide();
             $("#atype").hide();
            $("#commercial").hide();
            $("#plot").hide();
            $("#shop").show();
             $("#buresidential").hide();
            $("#bucommercial").hide();
             $("#bitype1").hide();
        }
        else if(id ==7) {
        
            $("#bitype1").show();
             $("#atype").hide();
        }
        else if(id ==15) {
           $("#apartment").show();
            $("#office").hide();
            $("#plot").hide();
            $("#commercial").hide();
             $("#shop").hide();
            $("#propertyhighlights1").hide();
              $("#buresidential").hide();
            $("#bucommercial").hide();
             $("#bitype1").hide();
              $("#atype").hide();
        }


          $.ajax({
        url :"<?= base_url().'property/getAmenities'; ?>",
        method:"post",
        dataType:"json",
        data:{
          id:id,
           "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
        },
        success:function(data) {
         if(data.status ==true) {
            $("#amenityview").html(data.msg);
            $(".csrf_token").val(data.csrf_token);
         }
        }
    });
    });

    $("#bitype").on("change",function() {
        var id = $(this).val();

        if(id ==1) {
                  $("#apartment").hide();
            $("#office").hide();
            $("#house").hide();
            $("#commercial").hide();
            $("#plot").hide();
            $("#shop").hide();
            $("#buresidential").hide();
            $("#bucommercial").show();
        }else if(id ==2) {
          $("#apartment").hide();
            $("#office").hide();
            $("#house").hide();
            $("#commercial").hide();
            $("#plot").hide();
            $("#shop").hide();
            $("#bucommercial").hide();
            $("#buresidential").show();
        }
    });


});


var i ='<?= count($getImage)?>';
var j = 5;
$(document).on('click','#add',function(){  
           i++;  
            if(i > j) {

            }else {
                  $('#tablechild').append("<tr id='row"+i+"'><td><input type='hidden' name='pimgid[]' value=''><input type='file' name='gallery[]'></td><td class='text-center'><button type='button' name='remove' id="+i+" class='btn btn-danger btn_remove'><i class='fa fa-minus'></i></button></td></tr>");
            }
            

      }); 
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 


$(document).ready(function() {
  $("#vtype").on("change",function(e) {
      e.preventDefault();
      var type = $(this).val();
      if(type ==1) {
        $("#uploadVideo").show();
        $("#ylink").hide();
      }

      else if(type ==2) {
        $("#uploadVideo").hide();
        $("#ylink").show();
      }
      else if(type =="") {
           $("#uploadVideo").hide();
        $("#ylink").hide();
      }
  });
});

$(document).ready(function() {
    $("#ownerrole").on('change',function(e) {
        e.preventDefault();
        var role = $(this).val();

        if(role ==2) {
          $("#cperiod").show(); 
        }else {
          $("#cperiod").hide(); 
        }
    });
});


$(document).ready(function() {
    $("#state").on('change',function(e) {
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            url :"<?= base_url().'property/getcity';?>",
            method:"post",
            dataType:"json",
            data :{
              id:id,
               "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
            },
            success:function(data) {
                $("#city").html('<option value="">Select City</option>');
                $("#city").html(data.msg);
                $(".csrf_token").val(data.csrf_token);
            
            }
        });
    });

     $("#city").on("change",function(e) {
      e.preventDefault();
      var city = $(this).val();
       $.ajax({
            url :"<?= base_url().'property/getarea';?>",
            method:"post",
            dataType:"json",
            data :{
              id:city,
               "<?= $this->security->get_csrf_token_name();?>": $(".csrf_token").val()
            },
            success:function(data) {
                $("#areaname").html('<option value="">Select Area</option>');
                $("#areaname").html(data.msg);
                $(".csrf_token").val(data.csrf_token);
            
            }
        });
  });
});

               </script>
