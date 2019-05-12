<div class="container">
      <h3>User - <b><?php echo $user_details->firstname . ' ' . $user_details->lastname;?></b></h3>
      <a href="<?php echo base_url();?>admin/users"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $user_details->firstname . ' ' . $user_details->lastname;?></td>
        </tr>
        <tr>
          <td><b>Email:</b></td>
          <td><?php echo $user_details->email;?></td>
        </tr>
        <tr>
          <td><b>Address:</b></td>
          <td><?php echo $user_details->address;?></td>
        </tr>
        <tr>
          <td><b>Contact:</b></td>
          <td><?php echo $user_details->contact;?></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/users/edit/<?php echo $user_details->user_id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>