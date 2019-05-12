
    <section class="reservation">
      <div class="container">
      <h3 class="center">Login</h3>
       	<div class="row flex justify-center">
       		<div class="col-xs-6 reservation-form">
          <?php $attr = array('class' => 'form-horizontal');?>
		      <?php echo form_open('', $attr);?>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Username</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Username" name="username" required="">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" id="" placeholder="Password" name="password" required="">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
              <!-- <button type="submit" class="btn btn-primary">Login</button> -->
              <input type="submit" name="submit" class="btn btn-primary orange" value="Login">
              <a href="<?php echo base_url();?>user/forgot_password" class="pull-right">Forgot Password?</a>
				    </div>
				  </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <span>Don't have an account?<a href="<?php echo base_url();?>user/register">Register here.</a></span>
            </div>
          </div>
				</form>
			</div>
		</div>

      </div>
    </section>