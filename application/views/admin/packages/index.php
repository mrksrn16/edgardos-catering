<div class="container">
  <h3>Packages</h3>
  <a href="<?php echo base_url();?>admin/packages/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/packages/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Package" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Name</th>
      <th>Details</th>
      <th></th>
    </tr>
    <?php if(count($packages)):?>
    <?php foreach($packages as $package):?>
    <tr>
      <td><?php echo $package->name;?></td>
      <td><?php echo strip_tags($package->details);?></td>
      <td style="min-width: 150px;">
        <a href="<?php echo base_url();?>admin/packages/view/<?php echo $package->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/packages/edit/<?php echo $package->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/packages/delete/<?php echo $package->id;?>" onclick="return confirm('Delete this package?')"><button class="btn btn-danger btn-xs">Delete</button></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No package found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>