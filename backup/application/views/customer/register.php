<section class="reservation">
      <div class="container">
      <h3 class="center">Register</h3>
        <div class="row flex justify-center">
          <div class="col-xs-6 reservation-form">
          <?php if($successMessage):?>
        <p class="success-message">
          Success. Your password is sent is to your email.
        </p>
        <?php endif;?>
        <?php $attr = array('class' => 'form-horizontal');?>
          <?php echo form_open('', $attr);?>
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
              <input type="tel" pattern="^(09|\+639)\d{9}$" class="form-control" id="" placeholder="Contact" name="contact" required="" maxlength="11">
            </div>
          </div>
           <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox" style="display: flex;">
                <label>
                  <input type="checkbox" required=""> 
                </label>
                <a href="<?php echo base_url();?>user/terms_condition" target="_blank">Accept Terms and Conditions</a>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <!-- <button type="button" class="btn btn-primary">Register</button> -->
              <input type="submit" name="submit" class="btn btn-primary orange" value="Register">
              <br><br>
              <a href="<?php echo base_url();?>user/login">Already have an account? Login here.</a>
            </div>
          </div>
        </form>
      </div>
    </div>

      </div>
    </section>