 <div class="container">
      <h3>Food - <b><?php echo $food->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/foods"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $food->name;?></td>
        </tr>
        <tr>
        <tr>
          <td><b>Price:</b></td>
          <td><?php echo $food->price;?></td>
        </tr>
        <tr>
          <td><b>Description:</b></td>
          <td><?php echo $food->description;?></td>
        </tr>
        <tr>
          <td><b>Category:</b></td>
          <td><?php echo $food->category;?></td>
        </tr>
          <td><b>Image:</b></td>
          <td>
            <div class="view-image-admin">
              <a href="<?php echo base_url();?>uploads/foods/<?php echo $food->image;?>" target="_blank">
                <img src="<?php echo base_url();?>uploads/foods/<?php echo $food->image;?>">
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/foods/edit/<?php echo $food->id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>
