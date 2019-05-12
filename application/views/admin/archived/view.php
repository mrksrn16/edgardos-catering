<div class="container">
	<a href="<?php echo base_url();?>admin/requests"><button class="btn btn-default"  style="margin-top: 20px;">Back</button></a>
	<h3>Archived ID - <b><?php echo str_pad($schedule->id, 5, "0", STR_PAD_LEFT);?></b></h3>
	<?php if($this->session->flashdata('message')):?>
	<div style="background: #f5f5f5;padding: 10px;margin-bottom: 10px;">
		<?php echo $this->session->flashdata('message');?>
	</div>
	<?php endif;?>
	<div class="col-lg-6">
	<a href="<?php echo base_url();?>admin/requests/edit/<?php echo $schedule->id;?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom: 10px;">Edit</a>
	<table class="table table-bordered">
		<tr>
			<td colspan="2" style="text-align: center;color:#fff;font-weight: bold;background: #e5b701;">
				Reservation Details
			</td>
		</tr>
		<tr>
			<td><b>Venue:</b></td>
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
		<tr>
			<td><b>Occasion:</b></td>
			<td><?php echo $schedule->occasion;?></td>
		</tr>
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
			<td><b>Additionals:</b></td>
			<td><?php echo $schedule->additionals;?></td>
		</tr>
		<tr>
			<td><b>Service Style:</b></td>
			<td><?php echo $schedule->service_style;?></td>
		</tr>
		<tr>
			<td><b>Assign Team:</b></td>
			<td><?php echo $schedule->team;?></td>
		</tr>
		
	</table>
	</div>
	<div class="col-lg-6">
		<div class="col-lg-12">
			<table class="table table-bordered">
			<?php $usr = $this->M_User->get_details($schedule->user_id);?>
			<tr>
				<td colspan="2" style="text-align: center;color:#fff;font-weight: bold;background: #e5b701;">
					Cutomer Information
				</td>
			</tr>
			<tr>
				<td><b>Name:</b></td>
				<td><?php echo $usr->firstname . ' ' . $usr->lastname;?></td>
			</tr>
			<tr>
				<td><b>Email:</b></td>
				<td><?php echo $usr->email;?> <a href="mailto:<?php echo $usr->email;?>" class="pull-right"><small>email customer</small></a></td>
			</tr>
			<tr>
				<td><b>Address:</b></td>
				<td><?php echo $usr->address;?></td>
			</tr>
			<tr>
				<td><b>Contact:</b></td>
				<td><?php echo $usr->contact;?> <a href="tel:<?php echo $usr->contact;?>" class="pull-right"><small>contact customer</small></a></td>
			</tr>
			</table>
		</div>
		<div class="col-lg-12">
			<table class="table table-bordered">
				<tr>
					<td colspan="2" style="text-align: center;color:#fff;font-weight: bold;background: #e5b701;">
						Computation
					</td>
				</tr>
				<tr>
					<!-- <td><b>Computation:</b></td> -->
					<td colspan="2">
						<p><b>Package:</b></p>
						<p><?php echo $package->name;?> - <i>(<?php echo $package->price;?> * <?php echo $schedule->no_guests;?>) = <?php echo $package->price * $schedule->no_guests;?></i></p>
						<p><b>Additional Foods:</b></p>
	       						<?php 
	       							$add_foods = explode(',',$schedule->additional_foods);
	       							foreach($add_foods as $food) {
	       								$this->db->where('id', $food);
	       								$food_details = $this->db->get('foods')->row();
	       								echo $food_details->name . ' - <i>' . $food_details->price. '</i><br>';
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
			<a href="<?php echo base_url();?>admin/archived/make_pending/<?php echo $schedule->id;?>" onclick="return confirm('Remove to archived?')" style="margin-top: 20px;margin-bottom:50px;display:block;"><button class="btn btn-warning">Revert</button></a>
		</div>
	</div>
</div>