<div class="container">
      <h3>Edit User - <?php echo $user_details->firstname . ' ' . $user_details->lastname;?></h3>
      <a href="<?php echo base_url();?>admin/users" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open('', $attr);?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
              <select class="form-control" name="role" required="">
                <?php if($this->session->userdata('role') == 'superadmin'):?><option value="Admin" <?php if($user_account->role == 'Admin'){ echo 'selected'; } ?>>Admin</option><?php endif;?>
                <option value="Customer" <?php if($user_account->role == 'Customer'){ echo 'selected'; } ?>>Customer</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Firstname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Firstname" name="firstname" required="" value="<?php echo $user_details->firstname;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Lastname" name="lastname" required="" value="<?php echo $user_details->lastname;?>">
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="" placeholder="Email" name="email" required=""value="<?php echo $user_details->email;?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Address" name="address" required="" value="<?php echo $user_details->address;?>">
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-10">
              <input type="tel" pattern="^(09|\+639)\d{9}$" maxlength="11" class="form-control" id="" placeholder="Contact" name="contact" required="" value="<?php echo $user_details->contact;?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" class="btn btn-primary" value="Save">
            </div>
          </div>
        </form>
    </div>