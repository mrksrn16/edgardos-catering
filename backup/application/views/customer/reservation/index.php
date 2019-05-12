<section class="reservation">
      <div class="container">
      <h3 class="custom-heading"><span>Make a Reservation</span></h3>
       	<div class="row flex justify-center">
       		<div class="col-xs-6 reservation-form relative">
       			<?php if(!$this->session->userdata('id')):?>
       			<div class="login-overlay">
       				You must login first. 
       				<a href="<?php echo base_url();?>user/login" style="color: #fff;">&nbsp;Login here</a>
       			</div>
       			<?php endif;?>

		       	<form class="form-horizontal">
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Firstname</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Firstname" name="firstname" value="<?php if($user_details) { echo $user_details->firstname; }?>" disabled>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Lastname</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Lastname" value="<?php if($user_details) { echo $user_details->lastname; }?>" disabled>
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
				      <input type="text" class="form-control" id="" placeholder="Address" name="address" value="<?php if($user_details) { echo $user_details->address; }?>" disabled>
				    </div>
				  </div>
				   <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Contact</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Contact" name="contact" value="<?php if($user_details) { echo $user_details->contact; }?>" disabled>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <a href="<?php echo base_url();?>reservation/details"><button type="button" class="btn btn-primary orange">Next</button></a>
				      <br><br>
				  		<p style="font-size: 12px;color: #999; font-weight: bold;">*edit your profile if you want a changes in this form.</p>
				    </div>
				  </div>
				</form>
			</div>
		</div>

      </div>
    </section>