 <div class="container">
      <h3>Team - <b><?php echo $team->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/teams"><button class="btn btn-default">Back</button></a>
      <table class="table table-bordered" style="margin-top: 10px;">
        <tr>
          <td><b>Name:</b></td>
          <td><?php echo $team->name;?></td>
        </tr>
        <tr>
          <td><b>Members:</b></td>
          <td><?php echo $team->members;?></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo base_url();?>admin/teams/edit/<?php echo $team->id;?>"><button class="btn btn-primary btn-xs">Update</button></a>
            <!-- <a href=""><button class="btn btn-success btn-xs">Print</button></a> -->
          </td>
        </tr>
      </table>
    </div>
