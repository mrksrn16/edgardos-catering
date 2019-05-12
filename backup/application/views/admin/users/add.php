<div class="container">
      <h3>Add User</h3>
      <a href="<?php echo base_url();?>admin/users" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open('', $attr);?>
        <?php if($successMessage):?>
        <p class="success-message">
          Success. Your password is sent is to your email.
        </p>
        <?php endif;?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
              <select class="form-control" name="role" required="">
                <option value="" disabled="" selected="">Select Role</option>
                <?php if($this->session->userdata('role') == 'superadmin'):?><option value="Admin">Admin</option><?php endif;?>
                <option value="Customer">Customer</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Firstname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Firstname" name="firstname" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Lastname" name="lastname" required="">
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="" placeholder="Email" name="email" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Address" name="address" required="">
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-10">
              <input type="tel" pattern="^(09|\+639)\d{9}$" maxlength="11" class="form-control" id="" placeholder="Contact" name="contact" required="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="reset" class="btn btn-default">Clear</button>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </form>
    </div>