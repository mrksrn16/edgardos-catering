<section class="packages">
      <div class="container">
      <h3 class="custom-heading"><span>Foods</span></h3>
       <div class="row flex justify-center">
        <?php if(count($foods)):?>
          <?php foreach($foods as $food):?>
           <div class="col-xs-3 marRight">
              <div class="card card-2">
                <div class="card-image-2">
                  <img src="<?php echo base_url();?>uploads/foods/<?php echo $food->image;?>">
                  <div class="absolute-div">
                    <p><?php echo $food->name;?></p>
                  </div>
                </div>
                <div class="card-details">
                  <p>
                    <?php echo $food->description;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach;?>
        <?php else:?>
          <p class="no-content">No foods found.</p>
        <?php endif;?>


       </div>
      </div>
    </section>