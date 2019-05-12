
    <section class="reservation">
      <div class="container">
      <h3 class="center">Login</h3>
       	<div class="row flex justify-center">
       		<div class="col-xs-6 reservation-form">
		       	<?php $attr = array('class' => 'form-horizontal'); ?>
          		<?php echo form_open('', $attr);?>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" id="" placeholder="Email" name="email" required="">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
              <!-- <button type="submit" class="btn btn-primary orange">Submit</button> -->
              		<input type="submit" name="submit" class="btn btn-primary orange" value="Submit">
				    </div>
				  </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a href="<?php echo base_url();?>user/login">Back</a>
            </div>
          </div>
				</form>
			</div>
		</div>

      </div>
    </section>