<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edgardo's Catering</title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/custom/style.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
    <style type="text/css">
      .navbar-nav>li>.dropdown-menu {
          background: #e5b701;
      }
      .dropdown-menu>li>a {
          color: #fff;
      }
      .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
        color: #fff;
        text-decoration: none;
        background-color: #ff9800;
    }
    #calendar {
        padding-top: 30px;
      }
    </style>
  </head>
  <body>
     <header class="relative">
      <div class="header-logo-customer">
        <img src="<?php echo base_url();?>assets/images/logo.png">
      </div>


      <div class="login-user">
        <?php if($this->session->userdata('id')):?>
          <a href="<?php echo base_url();?>user/profile"><span class="glyphicon glyphicon-user"></span> Profile</a>
          <a href="<?php echo base_url();?>user/logout"><span class="glyphicon glyphicon-off"></span>Logout</a>
        <?php else: ?>
          <a href="<?php echo base_url();?>user/login"><span class="glyphicon glyphicon-user"></span> Login</a>
        <?php endif;?>
      </div>
    

    </header>
    <nav class="navbar navbar-inverse no-border-radius">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Edgardos Catering</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php $page = $this->uri->segment(1);?>
              <li class="<?php if($page == 'home' || $page == ''){ echo 'active'; }?>"><a href="<?php echo base_url();?>">Home</a></li>
              <!-- <li class="<?php if($page == 'schedules'){ echo 'active'; }?>"><a href="<?php echo base_url();?>schedules">Make a Reservation</a>
              </li> -->

              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Make a Reservation
              <ul class="dropdown-menu">
                <?php $services = $this->M_Services->get_all(); ?>
                <?php if(count($services)):?>
                <?php foreach($services as $service):?>
                <!-- <li><a href="<?php echo base_url();?>admin/user/profile">Profile</a></li> -->
                <li><a href="<?php echo base_url();?>schedules/event/<?php echo $service->name;?>"><?php echo $service->name;?></a></li>
                <?php endforeach;?>
                <?php endif;?>
              </ul>
            </li>

              <li class="<?php if($page == 'packages'){ echo 'active'; }?>"><a href="<?php echo base_url();?>packages">Catering Packages</a></li>
              <li class="<?php if($page == 'foods'){ echo 'active'; }?>"><a href="<?php echo base_url();?>foods">Foods</a></li>
              <!-- <li class="<?php if($page == 'reservation'){ echo 'active'; }?>"><a href="<?php echo base_url();?>reservation">Make a Reservation</a></li> -->
              <li class="<?php if($page == 'about'){ echo 'active'; }?>"><a href="<?php echo base_url();?>about">About Us</a></li>
              <li class="<?php if($page == 'contact'){ echo 'active'; }?>"><a href="<?php echo base_url();?>contact">Contact Us</a></li>
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right"> -->
              
            <!-- </ul> -->
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    