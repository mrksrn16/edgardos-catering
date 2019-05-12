<div class="container">
  <h3>Events</h3>
  <a href="<?php echo base_url();?>admin/services/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/services/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Events" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
    <?php if(count($services)):?>
    <?php foreach($services as $service):?>
    <tr>
      <td><?php echo $service->name;?></td>
      <td><?php echo $service->description;?></td>
      <td>
        <a href="<?php echo base_url();?>admin/services/view/<?php echo $service->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/services/edit/<?php echo $service->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/services/delete/<?php echo $service->id;?>" onclick="return confirm('Delete this service?')"><button class="btn btn-danger btn-xs">Delete</button></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No service found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>