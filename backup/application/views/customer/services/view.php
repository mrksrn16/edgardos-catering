<div class="container">
      <h3 class="custom-heading"><span><?php echo $service->name;?></span></h3>
      
       <div class="row flex justify-center">
       <?php 
        $this->db->where('service_id', $service->id);
        $gallery = $this->db->get('services_gallery')->result();
       ?>
        <?php if($gallery):?>
          <?php foreach($gallery as $g):?>
           <div class="" style="width:250px;height:250px;margin: 0 10px 10px 0;">
              <a href="<?php echo base_url();?>uploads/services/<?php echo $g->image;?>" target="_blank">
                    <img src="<?php echo base_url();?>uploads/services/<?php echo $g->image;?>" style="width:100%;height: 100%;object-fit: cover;">
                </a>
            </div>
          <?php endforeach;?>
        <?php endif;?>

       </div>

        <p><b>Description: </b><?php echo $service->description;?></p>
       <p></p>
      </div>