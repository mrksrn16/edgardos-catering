<section class="">
      <div class="container">
      <h3 class=""><span>Reservation Details - ID : <?php echo $schedule->id;?></span></h3>
       	<div class="row flex justify-center">
       		<div class="col-xs-6">
       		<?php $attr = array('class' => 'form-horizontal');?>
       		<?php echo form_open('', $attr);?>
		       	<!-- <form class="form-horizontal"> -->
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Venue</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Venue" name="venue" required="" value="<?php echo $schedule->venue;?>">
				    </div>
				  </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Type of Event</label>
            <div class="col-sm-10">
              <select class="form-control" name="event_type" required="">
                <?php if(count($services)):?>
                <?php foreach($services as $service):?>
                <option value="<?php echo $service->id;?>" <?php if($service->id == $schedule->event_type){ echo 'selected'; }?>><?php echo $service->name;?></option>
                <?php endforeach;?>
                <?php endif;?>
              </select>
            </div>
          </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Date of Event</label>
				    <div class="col-sm-10">
              <?php $min_date =  date('Y-m-d', strtotime('+2 months'));?>
				      <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($schedule->event_date));?>" name="event_date" required="">
              <small>Wedding service must be reserved 5 months from today other services 2 months.</small>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Time of Event</label>
				    <div class="col-sm-10">
				      <input type="time" class="form-control" name="event_time" required="" value="<?php echo $schedule->event_time;?>">
				    </div>
				  </div>
				   <!-- <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Motif</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Motif" name="motif" required="" value="<?php echo $schedule->motif;?>">
				    </div>
				  </div> -->
				   <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Occasion Motif</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Occasion Motif" name="motif" value="<?php echo $schedule->motif;?>">
				    </div>
				  </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">No. of Guests</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="No. of Guest" name="no_guests" required="" value="<?php echo $schedule->no_guests;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Package</label>
            <div class="col-sm-10">
              <select class="form-control" name="package">
                <?php if($packages):?>
                  <?php foreach($packages as $package):?>
                    <option value="<?php echo $package->id?>" <?php if($package->id == $schedule->package){ echo 'selected'; }?>><?php echo $package->name;?></option>
                  <?php endforeach;?>
                <?php endif;?>
              </select>
            </div>
          </div>
           <div class="form-group flex align-center">
            <label for="" class="col-sm-2 control-label">Additionals</label>
            <div class="col-sm-10">
            <?php
              $adds = explode(",",$schedule->additionals);
              $chk_adds = array();
              foreach($adds as $add) {
                $chk_adds[] = $add;
              }
             ?>
              <input type="checkbox" name="additionals[]" class="check" value="Sounds and light with projector" <?php if(in_array("Sounds and light with projector", $chk_adds)){ echo 'checked';}?>>Sounds and light with projector
              <input type="checkbox" name="additionals[]" class="check" value="Photoboth for 2 hRs" <?php if(in_array("Photoboth for 2 hRs", $chk_adds)){ echo 'checked';}?>>Photoboth for 2 hRs
              <input type="checkbox" name="additionals[]" class="check" value="Photo and video" <?php if(in_array("Photo and video", $chk_adds)){ echo 'checked';}?>>Photo and video
              <input type="checkbox" name="additionals[]" class="check" value="Emcee" <?php if(in_array("Emcee", $chk_adds)){ echo 'checked';}?>>Emcee
              <input type="checkbox" name="additionals[]" class="check" value="Tiffany chair" <?php if(in_array("Tiffany chair", $chk_adds)){ echo 'checked';}?>>Tiffany chair
            </div>
          </div>
          <div class="form-group flex align-center">
            <label for="" class="col-sm-2 control-label">Service Style</label>
            <div class="col-sm-10">
            <?php
              $service_s = explode(",",$schedule->service_style);
              $serve_array = array();
              foreach($service_s as $service) {
                $serve_array[] = $service;
              }
             ?>
              <input type="checkbox" name="service_style[]" class="check" value="Plated service" <?php if(in_array("Plated service", $serve_array)){ echo 'checked'; }?>>Plated service
              <input type="checkbox" name="service_style[]" class="check" value="Family or lauriat" <?php if(in_array("Family or lauriat", $serve_array)){ echo 'checked'; }?>>Family or lauriat
              <input type="checkbox" name="service_style[]" class="check" value="Buffet" <?php if(in_array("Buffet", $serve_array)){ echo 'checked'; }?>>Buffet
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Assign Team</label>
            <div class="col-sm-10">
              <?php 
                $this->db->where('event_date', $schedule->event_date);
                $result = $this->db->get('schedules')->result();
                $reserved_team = array();
                foreach($result as $res) {
                  $reserved_team[] = $res->team;
                }
              ?>
              <select class="form-control" name="team" required="">
                <?php if(!in_array('Team A', $reserved_team)):?>
              	<option value="Team A" <?php if($schedule->team == "Team A"){ echo 'selected'; }?>>Team A</option>
                <?php endif;?>
                <?php if(!in_array('Team B', $reserved_team)):?>
              	<option value="Team B" <?php if($schedule->team == "Team B"){ echo 'selected'; }?>>Team B</option>
                <?php endif;?>
                <?php if(!in_array('Team C', $reserved_team)):?>
              	<option value="Team C" <?php if($schedule->team == "Team C"){ echo 'selected'; }?>>Team C</option>
                <?php endif;?>
              </select>
            </div>
          </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <!-- <button type="submit" class="btn btn-primary">Next</button> -->
				      <input type="submit" name="submit" class="btn btn-primary orange" value="Save">
				    </div>
				  </div>
				</form>
			</div>
		</div>

      </div>
    </section>

    <script type="text/javascript">
    	
    	$(document).ready(function () {

		     $(".check").on('change', function() {
		     	
			 });
		});
    </script>