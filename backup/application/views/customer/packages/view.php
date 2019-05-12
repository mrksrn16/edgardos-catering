<div class="container">
      <h3 class="custom-heading"><span><?php echo $package->name;?></span></h3>
      <p><b>Details:</b></p>
       <div class="row flex justify-center">
       <?php $foods = explode(',' , $package->foods);
       ?>
        <?php if($package->foods):?>
          <?php foreach($foods as $food):?>
          <?php 
            $this->db->where('name', $food);
            $food_details = $this->db->get('foods')->row();

          ?>
           <div class="col-xs-3 marRight">
              <div class="card card-2">
                <div class="card-image-2">
                  <img src="<?php echo base_url();?>uploads/foods/<?php echo $food_details->image;?>">
                  <div class="absolute-div">
                    <p><?php echo $food_details->name;?></p>
                  </div>
                </div>
                <!-- <div class="card-details">
                  <p style="white-space: pre-line;">
                    <?php echo strip_tags($food->details);?>
                  </p>
                </div> -->
              </div>
            </div>
          <?php endforeach;?>
        <?php endif;?>

       </div>

       <p><?php echo $package->details;?></p>
       
      </div>