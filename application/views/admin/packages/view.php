 <div class="container">
      <h3>Packages - <b><?php echo $package->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/packages"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $package->name;?></td>
        </tr>
        <tr>
        <tr>
          <td><b>Details:</b></td>
          <td style="white-space: pre-wrap;"><?php echo strip_tags($package->details);?></td>
        </tr>
          <td><b>Image:</b></td>
          <td>
            <div class="view-image-admin">
              <a href="<?php echo base_url();?>uploads/packages/<?php echo $package->image;?>" target="_blank">
                <img src="<?php echo base_url();?>uploads/packages/<?php echo $package->image;?>">
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/packages/edit/<?php echo $package->id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>
