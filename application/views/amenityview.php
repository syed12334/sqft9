       
<?php
    if(count($amenity) >0) {
        ?>
           <ul class="pro-feature-add pl-0">
             
              <?php
                  foreach ($amenity as $key => $value) {
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
              ?>
           </ul>
        <?php
    }else {

    }
?>
      
                                             
                                   