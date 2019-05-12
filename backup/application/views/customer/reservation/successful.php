<section class="reservation">
      <div class="container">
      <h3 class="custom-heading"><span>Successful</span></h3>
       	<div class="row flex justify-center">
       		<div class="col-xs-6 reservation-form relative">
       			<div id="printableArea">
	       			<h4>Reservation Details:</h4>
	       			<table class="table table-bordered">
	       				<tr>
	       					<td><b>Address:</b></td>
	       					<td><?php echo $schedule->venue;?></td>
	       				</tr>
	       				<tr>
	       					<?php $event = $this->M_Services->get_by_id($schedule->event_type);?>
	       					<td><b>Event Type:</b></td>
	       					<td><?php echo $event->name;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Event Date:</b></td>
	       					<td><?php echo date('M d Y', strtotime($schedule->event_date));?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Event Time:</b></td>
	       					<td><?php echo date('h:i: a', strtotime($schedule->event_time));?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Motif:</b></td>
	       					<td><?php echo $schedule->motif;?></td>
	       				</tr>
	       				<!-- <tr>
	       					<td><b>Occasion:</b></td>
	       					<td><?php echo $schedule->occasion;?></td>
	       				</tr> -->
	       				<tr>
	       					<td><b>No of Guests:</b></td>
	       					<td><?php echo $schedule->no_guests;?></td>
	       				</tr>
	       				<tr>
	       					<?php $package = $this->M_Packages->get_by_id($schedule->package);?>
	       					<td><b>Package:</b></td>
	       					<td><?php echo $package->name;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Additional Foods:</b></td>
	       					<td>
	       						<?php 
	       							if($schedule->additional_foods) {
	       								$add_foods = explode(',',$schedule->additional_foods);
		       							foreach($add_foods as $food) {
		       								$this->db->where('id', $food);
		       								$food_details = $this->db->get('foods')->row();
		       								echo $food_details->name . ', ';
		       							}
	       							}
	       						?>
	       					</td>
	       				</tr>
	       				<tr>
	       					<td><b>Additionals:</b></td>
	       					<td><?php echo $schedule->additionals;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Service Style:</b></td>
	       					<td><?php echo $schedule->service_style;?></td>
	       				</tr>
	       				<!-- <tr>
	       					<td><b>Assign Team:</b></td>
	       					<td><?php echo $schedule->team;?></td>
	       				</tr> -->
	       				<?php $usr = $this->M_User->get_details($schedule->user_id);?>
	       				<tr>
	       					<td><b>Name:</b></td>
	       					<td><?php echo $usr->firstname . ' ' . $usr->lastname;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Email:</b></td>
	       					<td><?php echo $usr->email;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Address:</b></td>
	       					<td><?php echo $usr->address;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Contact:</b></td>
	       					<td><?php echo $usr->contact;?></td>
	       				</tr>
	       				<tr>
	       					<td><b>Computation:</b></td>
	       					<td>
	       						<p><b>Package:</b></p>
	       						<p><?php echo $package->name;?> - <i>(<?php echo $package->price;?> * <?php echo $schedule->no_guests;?>) = <?php echo $package->price * $schedule->no_guests;?></i></p>
	       						<p><b>Additional Foods:</b></p>
	       						<?php 
	       							if($schedule->additional_foods) {
	       								$add_foods = explode(',',$schedule->additional_foods);
		       							foreach($add_foods as $food) {
		       								$this->db->where('id', $food);
		       								$food_details = $this->db->get('foods')->row();
		       								echo $food_details->name . ' - <i>' . $food_details->price. '/head</i><br>';
		       							}
	       							}
	       						?>
	       						<p><b>Additionals:</b></p>
	       						<?php
	       							$adds = explode(",",$schedule->additionals);
	       							$chk_adds = array();
	       							foreach($adds as $add) {
	       								$chk_adds[] = $add;
	       							}
	       						 ?>
	       						<?php if(in_array("Sounds and light with projector", $chk_adds)):?><p>Sounds and light with projector -<i>5000</i></p><?php endif;?>
	       						<?php if(in_array("Photoboth for 2 hRs", $chk_adds)):?><p>Photoboth for 2 hRs -<i>2000</i></p><?php endif;?>
	       						<?php if(in_array("Emcee", $chk_adds)):?><p>Emcee -<i>2000</i></p><?php endif;?>
	       						<?php if(in_array("Photo and video", $chk_adds)):?><p>Photo and video -<i>1500</i></p><?php endif;?>
	       						<?php if(in_array("Tiffany chair", $chk_adds)):?><p>Tiffany Chair</i></p><?php endif;?>
	       						<?php if(in_array("Motif", $chk_adds)):?><p>Motif - <i>500</i></p><?php endif;?>
	       					</td>
	       				</tr>
	       				<tr style="background: #eee;">
	       					<td><b>Total:</b></td>
	       					<td><b><?php echo $schedule->total;?></b></td>
	       				</tr>
	       			</table>
	       		</div>
       			<button class="btn btn-success" onclick="printDiv('printableArea')">Print</button>
       			<!-- <p style="font-size: 12px;color: #999; font-weight: bold;margin-top: 50px;">*please check your email for further instructions.</p> -->
			</div>
		</div>

      </div>
    </section>

    <div class="modal fade" id="myModal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Message</h4>
	      </div>
	      <div class="modal-body" style="padding-bottom: 50px;">
	      	<h3>Successful! Your request is sent, Thank you for getting touch with us.</h3>
	        <small><b>*kindly please check your email for further instructions.</b></small>
	      </div>
	      <!-- <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div> -->
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <script type="text/javascript">

	    $(window).on('load',function(){
	        $('#myModal').modal('show');
	        // alert();
	    });
	   //print div
      function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = printContents;
       window.print();
       document.body.innerHTML = originalContents;
      }
      
      window.onafterprint = function(){
        window.location.reload(true);
      }
    </script>
