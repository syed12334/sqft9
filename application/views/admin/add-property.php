<?php 
 // echo "<pre>";print_r($getProperty);exit;
$ar = []; $p=[];
 if(count($getPicture) >0) {
  foreach ($getPicture as $packagecount) {
     $pids = $packagecount->pid;
      $getPackage = $this->master_db->getRecords('packages',['id'=>$pids,'formdisplay!='=>1],'title,id,pprice');
      
      if(!empty($getPackage)) {
           $pid = $getPackage[0]->id;
        $getUserpackage = $this->master_db->getRecords('user_package',['user_id'=>$uid,'pid'=>$pid],'properties');
      $ar[] = $getUserpackage[0]->properties;
      }
    }

  }
$totalp = array_sum($ar);

?>
<?= $header?>
<style type="text/css">
.filepond--root  {
    width:500px
}
#atype {
  display: none;
}
#cperiod {
  display: none;
}
#areaname-error {
  color:red;
}

.filepond--drop-label {
    color: #4c4e53;
}

.filepond--label-action {
    text-decoration-color: #babdc0;
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
#ownerrole-error {
  color:red;
}
#owneraddress-error {
  color:red;
}
#city-error {
  color:red;
}
#state-error {
  color:red;
}
#country-error {
  color:red;
}
#address-error {
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
                       
                      <?php
                        if ( $totalp ==$propertycount) {
                          ?>
                          <center><h3 style='text-align:center'>Your package has expired </h3>
                            <a href='<?= base_url().'property/addpackages';?>' class='btn btn-danger' style='background-color: #c82333!important'>Renew Now</a>
                          </center>
                          <?php
                           
                        }else {
                          ?>
                           <form action="<?= base_url().'property/registerproperty';?>" id="formData" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="ppid" value="">
                              <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
                        <div class="single-add-property">
                            <h3>Property description</h3>
                            <div class="property-form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Property Title</label>
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter your property title">
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
                                                           <option value="<?= $getPackage[0]->id;?>"><?= $getPackage[0]->title." - Rs.".$getPackage[0]->pprice;?></option>
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
                                                            ?>
                                                            <option value="<?= $value->id;?>"><?= $value->name;?></option>
                                                            <?php
                                                        }
                                                    }
                                                   ?>
                                               </select>

                                                 <br /><br /> 
                                               <div id="atype">
                                                <div class="form-group">
                                                  <label for="face">Apartment Type</label>
                                               <select name="atype" id="atype" class="form-control" style="width:100%!important">
                                                   <option value="">Select Type</option>
                                                   <option value="1">Stand Alone Building</option>
                                                   <option value="2">Mid Society</option>
                                                   <option value="3">Gated Society</option>
                                                   <option value="4">Branded Society</option>
                                                  
                                               </select>
                                             </div>
                                               </div>
                                            
                                        </div>

                                              <div class="col-md-4" >
                                            
                                                <label for="face">Facing</label>
                                               <select name="face" class="form-control" id="face">
                                                   <option value="">Select Facing</option>
                                                   <option value="North">North</option>
                                                   <option value="South">South</option>
                                                   <option value="East">East</option>
                                                   <option value="West">West</option>
                                                  
                                               </select>
                                        
                                        </div>
                                        <div class="col-md-4">
                                            

                                             <label for="face">Member Role</label>
                                               <select name="ownerrole" class="form-control" id="ownerrole">
                                                   <option value="">Select Role</option>
                                                   <option value="1">Individual / Direct owner</option>
                                                   <option value="2">Broker</option>
                                                   <option value="3"> Builder / Developer</option>
                                                  
                                               </select>
                                               <br /> <br />
                                               <div id="cperiod">
                                                  <label for="face">Commission period</label>
                                               <select name="cperiod" id="cperiod" class="form-control" style="width:100%!important">
                                                   <option value="">Select </option>
                                                   <option value="1">15 Days</option>
                                                   <option value="2">1 Month</option>
                                                   <option value="3">No Commission</option>
                                                  
                                               </select>
                                               </div>

                                               
                                      
                                        </div>

                                         <div class="col-md-4" id="bitype1" style="margin:20px 0px">
                                           <label>Select type</label>
                                           <select id="bitype" name="bitype" class="form-control" style="width:100%!important">
                                               <option value="">Select type</option>
                                               <option value="1">Commercial</option>
                                               <option value="2">Residential</option>
                                           </select>

                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-md-12">
                                            <p>
                                                <label for="description">Property Description</label>
                                                <textarea id="description" name="prodesc" placeholder="Describe about your property" class="propertyhighlights"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div id="apartment">
                                            <div class="row">
                                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                                <select name="bed1" id="bed1" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                      <select name="bath1" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>
                                    
                
                
                                     <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area1" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail1" id="avail">
                                                       <option value="">Select Availability</option>
                                                     <option value="Immediate">Immediate</option>
                                                     <option value="Within 1 Month">Within 1 Month</option>
                                                     <option value="After One Month">After One Month</option>
                                                       <option value="Within 3 Month">Within 3 Month</option>
                                                       <option value="After Three Month">After Three Month</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                  
                                                   <select id="carpark" name="carpark1" class="form-control">
                                                     <option value="">Select option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                 <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="price1">
                                                <label for="price">Price</label>
                                                <input type="number" name="price1" placeholder="Eg: 100000" class="form-control" id="price">
                                            </div>
                                        </div>


                                     


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                                    <select name="floors"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>
                                    

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished1" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>
                                            </div>  
                                        </div>

<div id="house">
       <div class="row">
                                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                                 <select name="bed2" id="bed2" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                       <select name="bath2" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>
                                    
                
                
                                     <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area2" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail2" id="avail">
                                                       <option value="">Select Availability</option>
                                                     <option value="Immediate">Immediate</option>
                                                     <option value="Within 1 Month">Within 1 Month</option>
                                                     <option value="After One Month">After One Month</option>
                                                       <option value="Within 3 Month">Within 3 Month</option>
                                                       <option value="After Three Month">After Three Month</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                   
                                                    <select id="carpark" name="carpark2" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                 <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="price1">
                                                <label for="price">Price</label>
                                                <input type="number" name="price" placeholder="Eg: 100000" class="form-control" id="price">
                                            </div>
                                        </div>


                                     


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                                                          <select name="floors1"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>
                                    

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished2" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>
                                                <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="balcony1">
                                                <label for="price">Balcony</label>
                                                <input type="number" name="balcony" placeholder="Eg: 1" class="form-control" id="balcony">
                                            </div>
                                        </div>
</div>
</div>

                             <div id="commercial">
                                 <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="washroom1">
                                                <label for="price">Washroom</label>
                                                <input type="number" name="washroom1" placeholder="Eg: 1" class="form-control" id="washroom">
                                            </div>
                                        </div>
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">LEED Certification</label>
                                                <input type="text" name="leedcertificate1" placeholder="Enter LEED Certification" class="form-control" id="leedcertificate">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="cornerproperty1">
                                                <label for="cornerproperty">Corner Property</label>
                                                <input type="text" name="cornerproperty1" placeholder="Enter Maintenance Charges" class="form-control" id="cornerproperty">
                                            </div>
                                        </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking1" placeholder="Overlooking" class="form-control" id="overlooking">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area3" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                               
                                                                          <select name="floors4"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished3" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod1" placeholder="Enter Lock in Period" class="form-control" id="lockperiod">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                  
                                                    <select id="carpark" name="carpark3" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass1" id="buildingclass" class="form-control" placeholder="Building class">
                                                </div>
                                            </div>
                                 </div>
                             </div>           

                                         <div id="plot" style="width: 100%">
 <div class="row">
                                              
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">Project Name</label>
                                                <input type="text" name="projectname" placeholder="Enter Project Name" class="form-control" id="projectname">
                                            </div>
                                        </div>


                                      


                                        

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                
                                                    <select id="carpark" name="carpark4" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Transaction Type</label>
                                                      <select name="ttype" id="ttype" class="form-control">
                                                    <option value="">Select Option</option>
                                                    <option value="New Property">New Property</option>
                                                    <option value="Free Legal Title Check">Free Legal Title Check</option>
                                                </select>
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass1" id="buildingclass" class="form-control" placeholder="Building class">
                                                </div>
                                            </div>


                                             <div class="col-lg-12 col-md-12">
                                            <div class="form-group" id="propertyhighlights1">
                                                <label>Property Highlights</label>
                                                <textarea name="highlights" class="form-control propertyhighlights" id="propertyhighlights"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        </div>

                                         <div id="bucommercial">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area4" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                             
                                                                          <select name="floors5"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="washroom1">
                                                <label for="price">Washroom</label>
                                                <input type="number" name="washroom2" placeholder="Eg: 1" class="form-control" id="washroom">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking2" placeholder="Overlooking" class="form-control" id="overlooking">
                                            </div>
                                        </div>


                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod2" placeholder="Enter Lock in Period" class="form-control" id="lockperiod">
                                            </div>
                                        </div>

                                            <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Building Class</label>
                                                   <input type="text" name="buildingclass" id="buildingclass" class="form-control" placeholder="Building class">
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark5" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>

                                        

                                               <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="cornerproperty1">
                                                <label for="cornerproperty">Corner Property</label>
                                                <input type="text" name="cornerproperty" placeholder="Enter Maintenance Charges" class="form-control" id="cornerproperty">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished4" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>  

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="leedcertificate1">
                                                <label for="price">LEED Certification</label>
                                                <input type="text" name="leedcertificate" placeholder="Enter LEED Certification" class="form-control" id="leedcertificate">
                                            </div>
                                        </div>
                                            </div>
                                        </div>

                                         <div id="buresidential">
                                            <div class="row">
                                                
   <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="balcony1">
                                                <label for="price">Balcony</label>
                                                <input type="number" name="balcony1" placeholder="Eg: 1" class="form-control" id="balcony">
                                            </div>
                                        </div>



 <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="avail1">
                                                <label>Availability</label>
                                                   <select class="form-control" name="avail" id="avail">
                                                       <option value="">Select Availability</option>
                                                     <option value="Immediate">Immediate</option>
                                                     <option value="Within 1 Month">Within 1 Month</option>
                                                     <option value="After One Month">After One Month</option>
                                                       <option value="Within 3 Month">Within 3 Month</option>
                                                       <option value="After Three Month">After Three Month</option>
                                                   </select>
                                                </div>
                                            </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bed1">
                                               <label>Bedrooms</label>
                                                 <select name="bed1" id="bed1" class="form-control">
                                               <option value="">Select bedroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>
                                     
                
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="bath1">
                                                <label>Bathrooms</label>
                                                       <select name="bath" id="bath" class="form-control">
                                               <option value="">Select bathroom</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                           </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area5" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>


                                                <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark6" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                         <div id="shop">
                                            <div class="row">
                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="text" name="area" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                              <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                                                          <select name="floors3"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking3" placeholder="Overlooking" class="form-control" id="overlooking">
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="plotarea1">
                                                <label for="price">Plot Area</label>
                                                <input type="text" name="plotarea1" placeholder="Eg: 3200" class="form-control" id="plotarea">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="unitofloor1">
                                                <label for="price">Unit of Floor</label>
                                                <input type="text" name="unitofloor" placeholder="Enter Number of Floor" class="form-control" id="unitofloor">
                                            </div>
                                        </div>

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod" placeholder="Enter Lock in Period" class="form-control" id="lockperiod">
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="maintenance1">
                                                <label for="price">Maintenance Charges</label>
                                                <input type="text" name="maintenance" placeholder="Enter Maintenance Charges" class="form-control" id="maintenance">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark7" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>

                                             <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Parking Ratio</label>
                                                   <input type="text" name="parkingratio" id="parkingratio" class="form-control" placeholder="Parking Ratio">
                                                </div>
                                            </div>
</div>

                                        </div>                      
                <div id="office" style="padding:0px 20px;width:100%">
                    <div class="row">
                        

                                          <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="furnished1">
                                                <label for="price">Furnished Status</label>
                                               <select name="furnished5" id="furnished" class="form-control">
                                                   <option value="">Select option</option>
                                                   <option value="Furnished">Furnished</option>
                                                   <option value="Semi Furnished">Semi- Furnished</option>
                                                   <option value="Un Furnished">Un Furnished</option>
                                               </select>
                                            </div>
                                        </div>

                                           <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="area1">
                                                <label>Area (In sqft)</label>
                                                   <input type="number" name="area6" id="area" class="form-control" placeholder="Eg: 3200">
                                                </div>
                                            </div>

                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="carpetarea1">
                                                <label for="price">Carpet Area</label>
                                                <input type="text" name="carpetarea" placeholder="Enter Number of Carpet Area" class="form-control" id="carpetarea">
                                            </div>
                                        </div>


                                           <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="plotarea1">
                                                <label for="price">Plot Area</label>
                                                <input type="number" name="plotarea" placeholder="Eg: 3200" class="form-control" id="plotarea">
                                            </div>
                                        </div>

                                            <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="floor1">
                                                <label for="price">Number of Floor</label>
                                                                          <select name="floors2"  id="floor" class="form-control">
                                               <option value="">Select number of floors</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                               <option value="6">6</option>
                                               <option value="7">7</option>
                                               <option value="8">8</option>
                                               <option value="9">9</option>
                                               <option value="10">10</option>
                                               <option value="11">11</option>
                                               <option value="12">12</option>
                                               <option value="13">13</option>
                                               <option value="14">14</option>
                                               <option value="15">15</option>
                                               <option value="16">16</option>
                                               <option value="17">17</option>
                                               <option value="18">18</option>
                                               <option value="19">19</option>
                                               <option value="20">20</option>
                                               <option value="21">21</option>
                                               <option value="22">22</option>
                                               <option value="23">23</option>
                                               <option value="24">24</option>
                                               <option value="25">25</option>
                                               <option value="26">26</option>
                                               <option value="27">27</option>
                                               <option value="28">28</option>
                                               <option value="29">29</option>
                                               <option value="30">30</option>
                                               <option value="31">31</option>
                                               <option value="32">32</option>
                                               <option value="33">33</option>
                                               <option value="34">34</option>
                                               <option value="35">35</option>
                                               <option value="36">36</option>
                                               <option value="37">37</option>
                                               <option value="38">38</option>
                                               <option value="39">39</option>
                                               <option value="40">40</option>
                                               <option value="41">41</option>
                                               <option value="42">42</option>
                                               <option value="43">43</option>
                                               <option value="44">44</option>
                                               <option value="45">45</option>
                                               <option value="46">46</option>
                                               <option value="47">47</option>
                                               <option value="48">48</option>
                                               <option value="49">49</option>
                                               <option value="50">50</option>
                                             
                                           </select>
                                            </div>
                                        </div>



                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="unitofloor1">
                                                <label for="price">Unit of Floor</label>
                                                <input type="text" name="unitofloor1" placeholder="Enter Number of Washroom" class="form-control" id="unitofloor">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="overlooking1">
                                                <label for="price">Overlooking</label>
                                                <input type="text" name="overlooking" placeholder="Overlooking" class="form-control" id="overlooking">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <label for="price">Lock in Period</label>
                                                <input type="text" name="lockperiod3" placeholder="Enter Lock in Period" class="form-control" id="lockperiod">
                                            </div>
                                        </div>

                                         <div class="col-lg-4 col-md-4">
                                            <div class="form-group" id="carpark1">
                                                <label>Car Parking</label>
                                                    <select id="carpark" name="carpark" class="form-control">
                                                     <option value="">Select Option</option>
                                                     <option value="Available">Available</option>
                                                     <option value="Covered">Covered</option>
                                                     <option value="Un Available">Un Available</option>
                                                   </select>
                                                </div>
                                            </div>


                                         <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="maintenance1">
                                                <label for="price">Maintenance Charges</label>
                                                <input type="text" name="maintenance1" placeholder="Enter Maintenance Charges" class="form-control" id="maintenance">
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group" id="nooflift1">
                                                <label for="price">Number of Lift</label>
                                                <input type="number" name="nooflift" placeholder="Eg: 1" class="form-control" id="nooflift">
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
                                       
                                        <div class="form-group">

                                            <table class="table  table-bordered" id="tablechild" style="margin-top: 10px">
                            <tr>
                              <th width="20%">Gallery Media</th>
                            
                              <th class="text-center" width="5%"><span style="float: left;margin-right:10px">Add</span> <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                            </tr>
                          
                                   
                               
                           
                          </table>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                      <div class="form-group">
                                        <label>Video Type</label>
                                        <select name="vtype" class="form-control" id="vtype">
                                          <option value="">Select Option</option>
                                          <option value="1">Upload Video</option>
                                          <option value="2">Youtube Link</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                      <div class="form-group" id="uploadVideo">
                                        <label>Upload Video</label>
                                        <input type="file" name="uvideo" class="form-control">
                                      </div>
                                       <div class="form-group" id="ylink">
                                        <label>Youtube Link</label>
                                        <input type="url" name="ylink" class="form-control" placeholder="Youtube Link">
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
                                                   ?>
                                                   <option value="<?= $state->id;?>"><?= $state->name;?></option>
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
                                              <option value="">Select city</option>
                                              <?php
                                                if(count($city)) {
                                                  foreach ($city as  $value) {
                                                    ?>
                                                    <option value="<?= $value->id;?>"><?= $value->cname;?></option>
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
                                                    <option value="<?= $value->id;?>"><?= $value->areaname;?></option>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                  
                                    <div class="clearfix"></div>
                                        <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" placeholder="Enter Your Country" class="form-control" id="country" value="India" readonly>
                                        </div>
                                    </div>
                                     <div class="col-lg-6 col-md-12">
                                        <div class="form-group" style="margin-bottom: 5px">
                                            <label for="maps">Google Maps Iframe</label>
                                            <input type="text" name="maps" placeholder="Google Maps" id="maps" class="form-control">
                                        </div>
                                        <span style="color:red">(Visit google maps to generate your location iframe and paste it here)</span>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="maps">Address</label>
                                            <textarea cols="5" rows="5" class="form-control" placeholder="Enter Address" id="address" name="address"></textarea>
                                        </div>
                                    
                                    </div>
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
                                                ?>
                                                     <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-a<?= $value->id;?>" type="checkbox" name="amenities[]" value="<?= $value->id;?>">
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
                                                <textarea id="description" name="nearby" placeholder="Describe about nearby property" class="form-control" cols="4" rows="4"></textarea>
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
                                            <button type="submit" name="submit">Submit Property</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" class="csrf_token">
        <!-- END SECTION USER PROFILE -->
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
                owneraddress:"required",
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
                owneraddress :"Please enter owner address",
                areaname:"Please select areaname"
                           
              }
        });
              
            });



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


$(document).ready(function() {
 

      var i =0;var j=5;

      $('#add').click(function(){  
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

              if(data.status ==true) {
                   $("#city").html(data.msg);
                  $(".csrf_token").val(data.csrf_token);
              }
               
            
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