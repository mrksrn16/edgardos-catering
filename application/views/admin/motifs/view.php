 <div class="container">
      <h3>Motif - <b><?php echo $motif->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/motifs"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $motif->name;?></td>
        </tr>
        <tr>
          <td><b>Description:</b></td>
          <td><?php echo $motif->description;?></td>
        </tr>
          <td><b>Image:</b></td>
          <td>
            <div class="view-image-admin">
              <a href="<?php echo base_url();?>uploads/motifs/<?php echo $motif->image;?>" target="_blank">
                <img src="<?php echo base_url();?>uploads/motifs/<?php echo $motif->image;?>">
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/motifs/edit/<?php echo $motif->id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>
