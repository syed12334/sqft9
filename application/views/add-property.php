<?= $header?>

        <!-- START SECTION USER PROFILE -->
        <section >
            <div class="container-fluid">
                <div class="row">
   
                        <div class="col-md-12">
                        <div class="single-add-property">
                            <h3>Property description and price</h3>
                            <div class="property-form-group">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <label for="title">Property Title</label>
                                                <input type="text" name="title" id="title" placeholder="Enter your property title">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <label for="description">Property Description</label>
                                                <textarea id="description" name="pro-dexc" placeholder="Describe about your property"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Select status</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">Rent</li>
                                                        <li data-value="2" class="option">Sale</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Type</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">house</li>
                                                        <li data-value="2" class="option">commercial</li>
                                                        <li data-value="3" class="option">apartment</li>
                                                        <li data-value="4" class="option">lot</li>
                                                        <li data-value="5" class="option">garage</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Rooms</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">1</li>
                                                        <li data-value="2" class="option">2</li>
                                                        <li data-value="3" class="option">3</li>
                                                        <li data-value="4" class="option">4</li>
                                                        <li data-value="5" class="option">5</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Bedrooms</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">1</li>
                                                        <li data-value="2" class="option">2</li>
                                                        <li data-value="3" class="option">3</li>
                                                        <li data-value="4" class="option">4</li>
                                                        <li data-value="5" class="option">5</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Bath</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">1</li>
                                                        <li data-value="2" class="option">2</li>
                                                        <li data-value="3" class="option">3</li>
                                                        <li data-value="4" class="option">4</li>
                                                        <li data-value="5" class="option">5</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                
                
                                        <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                            <div class="form-group categories">
                                                <div class="nice-select form-control wide" tabindex="0"><span class="current">Garages</span>
                                                    <ul class="list">
                                                        <li data-value="1" class="option">1</li>
                                                        <li data-value="2" class="option">2</li>
                                                        <li data-value="3" class="option">3</li>
                                                        <li data-value="4" class="option">4</li>
                                                        <li data-value="5" class="option">5</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                
                                        
                
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <p class="no-mb">
                                                <label for="price">Year Built</label>
                                                <input type="text" name="price" placeholder="USD" id="price">
                                            </p>
                                        </div>
                
                                        <div class="col-lg-4 col-md-12">
                                            <p class="no-mb">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" placeholder="USD" id="price">
                                            </p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <p class="no-mb last">
                                                <label for="area">Area</label>
                                                <input type="text" name="area" placeholder="Sqft" id="area">
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Media</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Upload Property Images, Videos & Floor plan image</p>
                                        <form action="https://code-theme.com/file-upload" class="dropzone"></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-add-property">
                            <h3>property Location</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="address">Address</label>
                                            <input type="text" name="address" placeholder="Enter Your Address" id="address">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="city">City</label>
                                            <input type="text" name="city" placeholder="Enter Your City" id="city">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="state">State</label>
                                            <input type="text" name="state" placeholder="Enter Your State" id="state">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <p>
                                            <label for="country">Country</label>
                                            <input type="text" name="country" placeholder="Enter Your Country" id="country">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <p class="no-mb first">
                                            <label for="latitude">Google Maps Iframe</label>
                                            <input type="text" name="latitude" placeholder="Google Maps latitude" id="latitude">
                                        </p>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="single-add-property">
                            <h3>Amenities</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="pro-feature-add pl-0">
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-a" type="checkbox" name="check">
                                                        <label for="check-a">Air Conditioning</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-b" type="checkbox" name="check">
                                                        <label for="check-b">Swimming Pool</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-c" type="checkbox" name="check">
                                                        <label for="check-c">Central Heating</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-d" type="checkbox" name="check">
                                                        <label for="check-d">Laundry Room</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-e" type="checkbox" name="check">
                                                        <label for="check-e">Gym</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-g" type="checkbox" name="check">
                                                        <label for="check-g">Alarm</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-h" type="checkbox" name="check">
                                                        <label for="check-h">Window Covering</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-i" type="checkbox" name="check">
                                                        <label for="check-i">Refrigerator</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-j" type="checkbox" name="check">
                                                        <label for="check-j">TV Cable & WIFI</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fl-wrap filter-tags clearfix">
                                                <div class="checkboxes float-left">
                                                    <div class="filter-tags-wrap">
                                                        <input id="check-k" type="checkbox" name="check">
                                                        <label for="check-k">Microwave</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                               
                        <div class="single-add-property">
                            <h3>What's Nearby</h3>
                            <div class="property-form-group">
                                <form>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <textarea id="description" name="pro-dexc" placeholder="Describe about nearby property"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                  
                
                
                                   
                                </form>
                            </div>
                        </div>
                
                
                        <div class="single-add-property">
                            <h3>Owner Information</h3>
                            <div class="property-form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <p>
                                            <label for="con-name">Name</label>
                                            <input type="text" placeholder="Enter Your Name" id="con-name" name="con-name">
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb last">
                                            <label for="con-phn">Phone</label>
                                            <input type="text" placeholder="Enter Your Phone Number" id="con-phn" name="con-phn">
                                        </p>
                                    </div>
                                
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb first">
                                            <label for="con-email">Email</label>
                                            <input type="email" placeholder="Enter Your Email" id="con-email" name="con-email">
                                        </p>
                                    </div>
                                    
                
                                    <div class="col-lg-12 col-md-12">
                                        <p>
                                            <label for="con-user">Address</label>
                                            <textarea  placeholder="Enter Your Username" id="con-user" name="con-user"></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="add-property-button pt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="prperty-submit-button">
                                            <button type="submit">Submit Property</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->

<?= $footer?>