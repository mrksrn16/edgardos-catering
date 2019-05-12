<div class="container">
  <h3>Users</h3>
  <a href="<?php echo base_url();?>admin/users/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/users/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search User" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Name</th>
      <th>Username</th>
      <th></th>
    </tr>
    <?php if(count($users)):?>
    <?php foreach($users as $user):?>
    <tr>
      <?php $usr = $this->M_User->get_details($user->id);?>
      <?php $usr_accounts = $this->M_User->get_accounts($user->id);?>
      <td><?php echo $usr->firstname . ' ' . $usr->lastname;?></td>
      <td><?php echo $usr_accounts->username;?></td>
      <td>
        <a href="<?php echo base_url();?>admin/users/view/<?php echo $user->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/users/edit/<?php echo $user->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/users/delete/<?php echo $user->id;?>" onclick="return confirm('Delete this user?')"><button class="btn btn-danger btn-xs">Delete</button></a>
        <a href="<?php echo base_url();?>admin/users/<?php if($usr_accounts->status == 1) { echo 'deactivate'; } else { echo 'activate'; }  ?>/<?php echo $usr_accounts->id;?>"><?php if($usr_accounts->status == 1) { echo 'Deactivate'; } else { echo 'Activate'; }  ?></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No users found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>