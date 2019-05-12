<div class="container">
  <h3>Schedules</h3>
  <!-- <a href="<?php echo base_url();?>admin/services/add"><button class="btn btn-primary">Add new</button></a> -->
  <div class="input-group pull-right col-xs-12" style="margin-bottom: 10px;">
   <!--  <?php echo form_open('admin/schedules/filter_status');?>
      <select class="form-control" style="width: 200px;margin-right: 10px;" name="status" onchange="this.form.submit();">
        <option value="" disabled selected>Select status</option>
        <option value="Pending">Pending</option>
        <option value="Rejected">Rejected</option>
        <option value="Accepted">Accepted</option>
      </select>
    </form> -->
    <?php echo form_open('admin/schedules/filter_events');?>
      <select class="form-control" style="width: 200px;margin-right: 10px;" name="event_id" onchange="this.form.submit();">
        <option value="" disabled selected>Select Event Type</option>
        <?php if($events):?>
          <?php foreach($events as $event):?>
            <option value="<?php echo $event->id;?>"><?php echo $event->name;?></option>
          <?php endforeach;?>
        <?php endif;?>
      </select>
    </form>
    <?php $attr = array('class' => 'form-inline pull-right');?>
    <?php echo form_open('admin/schedules/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search schedule" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>

  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Date</th>
      <th>Time</th>
      <th>Event Type</th>
      <th>Customer</th>
      <th></th>
    </tr>
    <?php if(count($schedules)):?>
    <?php foreach($schedules as $schedule):?>
    <tr>
      <td><?php echo $schedule->event_date;?></td>
      <td><?php echo $schedule->event_time;?></td>
      <?php $event = $this->M_Services->get_by_id($schedule->event_type);?>
      <td><?php echo $event->name;?></td>
      <?php $usr = $this->M_User->get_details($schedule->user_id);?>
      <td><a href="<?php echo base_url();?>admin/users/view/<?php echo $schedule->user_id;?>" target="_blank"><?php echo $usr->firstname . ' ' . $usr->lastname;?></a></td>
      <td>
        <a href="<?php echo base_url();?>admin/schedules/view/<?php echo $schedule->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <label class="btn-<?php if($schedule->status == 'pending'){ echo 'warning';} else if($schedule->status == 'rejected') { echo 'danger'; } else if($schedule->status == 'accepted') { echo 'success'; } else if($schedule->status == 'cancelled') { echo 'danger'; } ?> btn-xs"><?php echo ucfirst($schedule->status);?></label>
       <!--  <a href="<?php echo base_url();?>admin/services/edit/<?php echo $service->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/services/delete/<?php echo $service->id;?>" onclick="return confirm('Delete this service?')"><button class="btn btn-danger btn-xs">Delete</button></a> -->
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="5">No schedules found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>