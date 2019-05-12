<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edgardo's Catering</title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/custom/style.css" rel="stylesheet">
  </head>
  <body>

    <section class="login">
      <div class="container">
      <div class="login-logo">
        <img src="<?php echo base_url();?>assets/images/logo.png">
      </div>
       	<div class="row flex justify-center">
       		<div class="col-xs-6 reservation-form">
          <h3 class="center">Forgot Password</h3>
          <?php $attr = array('class' => 'form-horizontal'); ?>
          <?php echo form_open('', $attr);?>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" id="" placeholder="Email" required="" name="email">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
              <a href="<?php echo base_url();?>admin/user/login" class="pull-right">Back to login.</a>
				    </div>
				  </div>
				</form>
			</div>
		</div>

      </div>
    </section>

    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>