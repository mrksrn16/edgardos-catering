<div class="container">
  <h3>Archived</h3>
  <!-- <a href="<?php echo base_url();?>admin/services/add"><button class="btn btn-primary">Add new</button></a> -->
  <div class="input-group pull-right col-xs-12" style="margin-bottom: 10px;">
    <?php echo form_open('admin/archived/filter_events');?>
      <select class="form-control" style="width: 200px;margin-right: 10px;" name="event_id" onchange="this.form.submit();">
        <option value="" disabled selected>Select Event Type</option>
        <?php if($events):?>
          <?php foreach($events as $event):?>
            <option value="<?php echo $event->id;?>"><?php echo $event->name;?></option>
          <?php endforeach;?>
        <?php endif;?>
      </select>
    </form>
  </div>

  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Event Date</th>
      <th>Time</th>
      <th>Event Type</th>
      <th>Customer</th>
      <th>Date Request</th>
      <th></th>
    </tr>
    <?php if(count($schedules)):?>
    <?php foreach($schedules as $schedule):?>
    <?php 
      $date = date('Y-m-d', strtotime($schedule->date));
      $plus3days = date('Y-m-d', strtotime($date. ' + 3 days'));
      $now = date('Y-m-d');
    ?>
    <tr style="background: <?php if($now >= $plus3days){ echo 'rgba(255, 0, 0, .4)';  }?>">
      <td><?php echo date('M d Y', strtotime($schedule->event_date));?>
        <?php if($now >= $plus3days): ?>
        <p><small>Request date is beyond 3 days.</small></p>
        <?php endif;?>
      </td>
      <td><?php echo $schedule->event_time;?></td>
      <?php $event = $this->M_Services->get_by_id($schedule->event_type);?>
      <td><?php echo $event->name;?></td>
      <?php $usr = $this->M_User->get_details($schedule->user_id);?>
      <td><a href="<?php echo base_url();?>admin/users/view/<?php echo $schedule->user_id;?>" target="_blank"><?php echo $usr->firstname . ' ' . $usr->lastname;?></a></td>
      <td><?php echo date('M d Y', strtotime($schedule->date));?></td>
      <td>
        <a href="<?php echo base_url();?>admin/archived/view/<?php echo $schedule->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <label class="btn-<?php if($schedule->status == 'pending'){ echo 'warning';} else if($schedule->status == 'rejected') { echo 'danger'; }  ?> btn-xs"><?php echo ucfirst($schedule->status);?></label>
       <!--  <a href="<?php echo base_url();?>admin/services/edit/<?php echo $service->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/services/delete/<?php echo $service->id;?>" onclick="return confirm('Delete this service?')"><button class="btn btn-danger btn-xs">Delete</button></a> -->
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="5">No requests found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>