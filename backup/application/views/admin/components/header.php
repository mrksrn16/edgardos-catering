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
      #calendar {
        padding-top: 30px;
      }
    </style>
  </head>
  <body class="admin-body">

    <header>
      <div class="header-logo">
        <img src="<?php echo base_url();?>assets/images/logo.png">
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
          <a class="navbar-brand" href="#">Edgardo's Catering</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php $page = $this->uri->segment(2);?>
            <!-- <li class="<?php if($page == 'dashboard') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/dashboard">Home <span class="sr-only">(current)</span></a></li> -->
            <li class="<?php if($page == 'calendar') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/calendar">Calendar</a></li>
            <li class="<?php if($page == 'users') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/users">Users</a></li>
            <li class="<?php if($page == 'services') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/services">Events</a></li>
            <li class="<?php if($page == 'motifs') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/motifs">Motifs</a></li>
            <li class="<?php if($page == 'schedules') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/schedules">Schedules</a></li>
            <li class="<?php if($page == 'reports') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/reports">Reports</a></li>
            <li class="<?php if($page == 'foods') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/foods">Foods</a></li>
            <li class="<?php if($page == 'packages') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/packages">Packages</a></li>
            <li class="<?php if($page == 'teams') { echo 'active'; }?>"><a href="<?php echo base_url();?>admin/teams">Teams</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-bell"></span>
              <?php $pendingSched = $this->M_Schedules->get_pending();?>
              <?php if($pendingSched):?>
              <span class="badge" style="position: absolute; top: 10px; right: 0; background: #009688;"><?php echo count($pendingSched);?></span>
              <?php endif;?>
              </a>
              <ul class="dropdown-menu">
                <!-- <li><a href="<?php echo base_url();?>admin/user/profile">Profile</a></li> -->
                <li><a href="<?php echo base_url();?>admin/requests">View requests</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <?php 
              $this->db->where('user_id', $this->session->userdata('id'));
              $user_details = $this->db->get('user_details')->row();
              ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user_details->firstname;?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>admin/user/profile">Profile</a></li>
                <li><a href="<?php echo base_url();?>admin/user/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>