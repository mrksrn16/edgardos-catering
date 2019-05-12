<div class="container">
	<!-- <form class="form-horizontal"> -->
	<h3 class="custom-heading"><span>Profile</span></h3>
	<?php $attr = array('class' => 'form-horizontal');?>
	<?php echo form_open('', $attr);?>
	  <div class="form-group" style="margin-top: 20px;">
	    <label for="" class="col-sm-2 control-label">Firstname</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="" placeholder="Firstname" name="firstname" value="<?php if($user_details) { echo $user_details->firstname; }?>" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Lastname</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="" placeholder="Lastname" value="<?php if($user_details) { echo $user_details->lastname; }?>" name="lastname" required>
	    </div>
	  </div>
	   <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" id="" placeholder="Email" value="<?php if($user_details) { echo $user_details->email; }?>" disabled>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Address</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="" placeholder="Address" name="address" value="<?php if($user_details) { echo $user_details->address; }?>" required>
	    </div>
	  </div>
	   <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Contact</label>
	    <div class="col-sm-10">
	      <input type="tel" pattern="^(09|\+639)\d{9}$" maxlength="11" class="form-control" id="" placeholder="Contact" name="contact" value="<?php if($user_details) { echo $user_details->contact; }?>" required>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="" placeholder="Password" name="password">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <!-- <button type="submit" class="btn btn-primary orange" name="submit">Save</button> -->
	      <input type="submit" name="submit" value="Save" class="btn btn-primary orange">
	      <br><br>
	    </div>
	  </div>
	</form>
</div>