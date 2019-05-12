<div class="container">
  <h3>Reports</h3>
  <!-- <a href="<?php echo base_url();?>admin/services/add"><button class="btn btn-primary">Add new</button></a> -->
  <div class="input-group pull-right col-xs-12" style="margin-bottom: 10px;">
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/reports/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Reports" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
    <?php echo form_open('admin/reports/filter_date');?>
      <div style="display: flex;align-items: center;">
      <small>Filter by event date:</small>
      <input type="date" name="date" class="form-control" style="width: 200px;margin-left: 10px;" onchange="this.form.submit();">
      </div>
    </form>
    <!-- <?php echo form_open('admin/schedules/filter_events');?>
      <select class="form-control" style="width: 200px;margin-right: 10px;" name="event_id" onchange="this.form.submit();">
        <option value="" disabled selected>Select Event Type</option>
        <?php if($events):?>
          <?php foreach($events as $event):?>
            <option value="<?php echo $event->id;?>"><?php echo $event->name;?></option>
          <?php endforeach;?>
        <?php endif;?>
      </select>
    </form> -->
    <!-- <?php $attr = array('class' => 'form-inline pull-right');?>
    <?php echo form_open('admin/schedules/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search schedule" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form> -->
  </div>

  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Request ID</th>
      <th>Date</th>
      <th>Time</th>
      <th>Event Type</th>
      <th>Customer</th>
      <th>Status</th>
    </tr>
    <?php if(count($schedules)):?>
    <?php foreach($schedules as $schedule):?>
    <tr>
      <td>
        <?php if($schedule->status == 'pending'):?>
          <a href="<?php echo base_url();?>admin/requests/view/<?php echo $schedule->id;?>"><?php echo $schedule->id;?></a>
        <?php else:?>
          <a href="<?php echo base_url();?>admin/schedules/view/<?php echo $schedule->id;?>"><?php echo $schedule->id;?></a>
        <?php endif;?>
      </td>
      <td><?php echo $schedule->event_date;?></td>
      <td><?php echo $schedule->event_time;?></td>
      <?php $event = $this->M_Services->get_by_id($schedule->event_type);?>
      <td><?php echo $event->name;?></td>
      <?php $usr = $this->M_User->get_details($schedule->user_id);?>
      <td><a href="<?php echo base_url();?>admin/users/view/<?php echo $schedule->user_id;?>" target="_blank"><?php echo $usr->firstname . ' ' . $usr->lastname;?></a></td>
      <td><?php echo ucfirst($schedule->status);?></td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="5">No schedules found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>