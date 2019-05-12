<div class="container">
      <h3 class="custom-heading"><span>Packages</span></h3>
       <div class="row flex justify-center">
        <?php if(count($packages)):?>
          <?php foreach($packages as $package):?>
             <div class="col-xs-3 marRight">
              <a href="<?php echo base_url();?>packages/view/<?php echo $package->id;?>">
                <div class="card card-2">
                  <div class="card-image-2">
                    <img src="<?php echo base_url();?>uploads/packages/<?php echo $package->image;?>">
                    <div class="absolute-div">
                      <p><?php echo $package->name;?></p>
                    </div>
                  </div>
                  <div class="card-details">
                    <p style="white-space: pre-line;">
                      <?php echo strip_tags($package->details);?>
                    </p>
                  </div>
                </div>
              </a>
              </div>
          <?php endforeach;?>
        <?php else:?>
          <p class="no-content">No package found.</p>
        <?php endif;?>


       </div>
      </div>