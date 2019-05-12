<div class="container">
	<h3 class="custom-heading"><span>Contact</span></h3>
	<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
		<div class="col-sm-6">
			<div class="map" style="height: 500px; background: #ccc;">
				
			</div>
		</div>
		<div class="col-sm-6">
			<div style="padding: 10px 0;">
				<h4>Details</h4>	
				<p><b>Location: </b>Karuhuatan Gen. T Valenzuela City</p>
				<p><b>Email: </b>edgardo@gmail.com</p>
			</div>

			<?php $attr = array('class' => 'form-horizontal');?>
       		<?php echo form_open('', $attr);?>
       		<h4>Message Us</h4>	
	       	<!-- <form class="form-horizontal"> -->
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="" placeholder="Name" name="name" required="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="" placeholder="Email" name="email" required="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Subject</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="" placeholder="Subject" name="subject">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Message</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" name="message" placeholder="Message" required=""></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <!-- <button type="submit" class="btn btn-primary">Next</button> -->
			      <input type="submit" name="submit" class="btn btn-primary orange" value="Send">
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div>