<div class="container">
  <h3>Foods</h3>
  <a href="<?php echo base_url();?>admin/foods/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/foods/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Foods" name="keyword">
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
    <?php if(count($foods)):?>
    <?php foreach($foods as $food):?>
    <tr>
      <td><?php echo $food->name;?></td>
      <td><?php echo $food->price;?></td>
      <td><?php echo $food->description;?></td>
      <td>
        <a href="<?php echo base_url();?>admin/foods/view/<?php echo $food->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/foods/edit/<?php echo $food->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/foods/delete/<?php echo $food->id;?>" onclick="return confirm('Delete this food?')"><button class="btn btn-danger btn-xs">Delete</button></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No food found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>