 <div class="container">
      <h3>Event - <b><?php echo $service->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/services"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $service->name;?></td>
        </tr>
        <tr>
          <td><b>Description:</b></td>
          <td><?php echo $service->description;?></td>
        </tr>
          <td><b>Image:</b></td>
          <td>
            <div class="view-image-admin">
              <a href="<?php echo base_url();?>uploads/services/<?php echo $service->image;?>" target="_blank">
                <img src="<?php echo base_url();?>uploads/services/<?php echo $service->image;?>">
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td>Gallery</td>
          <td>
            <?php
            $this->db->where('service_id', $service->id);
            $gallery = $this->db->get('services_gallery')->result();
            ?>
            <?php if($gallery):?>
              <?php foreach($gallery as $g):?>
              <div class="" style="display: inline-block;margin-right: 10px;position: relative;">
                <a href="<?php echo base_url();?>admin/services/remove_image/<?php echo $g->id;?>/<?php echo $service->id;?>"><button class="btn btn-xs btn-danger" style="position: absolute;right:10px;top:20px;"><span class="glyphicon glyphicon-remove"></span></button></a>
                <img src="<?php echo base_url();?>uploads/services/<?php echo $g->image;?>" style="width: 250px;height:250px;object-fit: contain;">
              </div>
              <?php endforeach;?>
            <?php else:?>
              <p>No photos found.</p>
            <?php endif;?>
            <?php echo form_open_multipart('admin/services/add_gallery');?>
              <small>Add photo</small>
                <input type="hidden" name="service_id" value="<?php echo $service->id;?>">
                <input type="file" name="photo" class="form-control" required="">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/services/edit/<?php echo $service->id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>
