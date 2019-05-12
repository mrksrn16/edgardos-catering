<div class="container">
  <h3>Teams</h3>
  <a href="<?php echo base_url();?>admin/teams/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/teams/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Team" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Name</th>
      <th>Price</th>
      <th>Description</th>
      <th></th>
    </tr>
    <?php if(count($teams)):?>
    <?php foreach($teams as $team):?>
    <tr>
      <td><?php echo $team->name;?></td>
      <td><?php echo $team->members;?></td>
      <td>
        <a href="<?php echo base_url();?>admin/teams/view/<?php echo $team->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/teams/edit/<?php echo $team->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <!-- <a href="<?php echo base_url();?>admin/teams/delete/<?php echo $team->id;?>" onclick="return confirm('Delete this team?')"><button class="btn btn-danger btn-xs">Delete</button></a> -->
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No teams found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>