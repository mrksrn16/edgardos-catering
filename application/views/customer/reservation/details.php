<style type="text/css">
  .form-control.error {
    border: 1px solid red;
  }
  @media (min-width: 900px) {
    .modal-dialog {
        width: 900px;
    }
  }

</style>
<section class="reservation">
      <div class="container">
      <h3 class="custom-heading"><span>Reservation Details</span></h3>
       	<div class="row flex justify-center">
          <?php $attr = array('class' => 'form-horizontal', 'style' => 'width:100%');?>
          <?php echo form_open('', $attr);?>
       		<div class="col-xs-12 reservation-form">
		       	<!-- <form class="form-horizontal"> -->
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Address</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="House no, Street, Brgy, City" name="venue" required="">
              <small>Inside the Camanava Area only.</small>
				    </div>
				  </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Type of Event</label>
            <div class="col-sm-10">
              <select class="form-control" name="event_type" required="">
                <?php if(count($services)):?>
                <?php foreach($services as $service):?>
                <option value="<?php echo $service->id;?>"><?php echo $service->name;?></option>
                <?php endforeach;?>
                <?php endif;?>
              </select>
            </div>
          </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Date of Event</label>
				    <div class="col-sm-10">
              <?php $min_date =  date('Y-m-d', strtotime('+2 months'));?>
				      <input type="date" class="form-control" value="<?php echo $date;?>" name="event_date" min="<?php echo $min_date;?>" required="">
              <small>Wedding service must be reserved 5 months from today other services 2 months.</small>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Time of Event</label>
				    <div class="col-sm-10">
				      <input type="time" class="form-control" name="event_time" required="">
				    </div>
				  </div>
				   <!-- <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Motif</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" placeholder="Motif" name="motif" required="">
				    </div>
				  </div> -->
				   <div class="form-group">
				    <label for="" class="col-sm-2 control-label">Occasion Motif</label>
				    <div class="col-sm-10">
				      <!-- <input type="text" class="form-control" id="" placeholder="Occasion" name="occasion" required=""> -->
              <?php 
                $motif_debut = ['Fairy tale', 'Parasian', 'Purple enchanted forest', 'Red riding hood -black and red', 'Beach inspired', 'Sunflower', 'Black and pink', 'Bohemian'];
                $motif_kiddie = ['Disney', 'Princess', 'Superhero'];
                $motif_all = ['Red and black', 'Pink and black', 'White and black', 'Black and yellow', 'Blue and black', 'Red and white', 'Pink and white', 'White and white', 'Blue and white', 'Yellow and green', 'Red and blue', 'Others'];
              ?>
              <select class="form-control" name="motif" id="motifSelect">
                <option selected="" disabled="" value="">--Select Occasion Motif--</option>
                <!-- <optgroup label="Motif for debut"> -->
                  <?php foreach($motif_debut as $debut):?>
                    <option value="<?php echo $debut;?>"><?php echo $debut;?></option>
                  <?php endforeach;?>
                <!-- </optgroup> -->
                <!-- <optgroup label="Motif for  kiddie /christening party"> -->
                  <?php foreach($motif_kiddie as $kiddie):?>
                    <option value="<?php echo $kiddie;?>"><?php echo $kiddie;?></option>
                  <?php endforeach;?>
                <!-- </optgroup>                   -->
                <!-- <optgroup label="For all events motif"> -->
                  <?php foreach($motif_all as $all):?>
                    <option value="<?php echo $all;?>"><?php echo $all;?></option>
                  <?php endforeach;?>
                <!-- </optgroup>  -->
                </option>
              </select>

              <input type="text" class="form-control" id="motif" placeholder="Other Motif" name="other_motif" style="margin-top: 10px;">

				    </div>
				  </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">No. of Guests</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="No. of Guest" name="no_guests" required="" min="100" id="noGuests">
              <small>Minimum of 100 guests</small>
            </div>
          </div>
          
			</div>
        <div class="col-xs-12 reservation-form" style="margin-top: 20px;">
          <div class="form-group">
            <p class="col-sm-12">Select first packages then go to Additionals.</p>
            <div class="row"></div>
            <label for="" class="col-sm-2 control-label">Packages</label>
            <div class="col-sm-12">
              <!-- <select class="form-control" name="package">
                <?php if($packages):?>
                  <?php foreach($packages as $package):?>
                    <option value="<?php echo $package->id?>" style="display:<?php if($package->name == 'AMENITIES'){ echo 'none'; } ?>"><?php echo $package->name;?></option>
                  <?php endforeach;?>
                <?php endif;?>
              </select> -->
              <?php if($packages):?>
                  <?php foreach($packages as $package):?>
                    <div class="col-xs-4" style="display:<?php if($package->name == 'AMENITIES'){ echo 'none'; } ?>">
                      <div class="card card-2">
                        <div class="card-image-2">
                          <img src="<?php echo base_url();?>uploads/packages/<?php echo $package->image;?>">
                          <div class="absolute-div">
                            <p><?php echo $package->name;?></p>
                          </div>
                        </div>
                        <div class="card-details">
                          <a href="#" data-toggle="modal" data-target="#myModal<?php echo $package->id?>"><p style="white-space: pre-line;">See details</p></a>
                          <input type="radio" name="package" value="<?php echo $package->id?>" required> <small>Select this package</small>
                        </div>
                      </div>
                    </div>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $package->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $package->id?>">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel<?php echo $package->id?>"><?php echo $package->name;?></h4>
                              </div>
                              <div class="modal-body">
                                
                                <div class="row flex justify-center">
                                 <?php $foods = explode(',' , $package->foods);
                                 ?>
                                  <?php if($package->foods):?>
                                    <?php foreach($foods as $food):?>
                                    <?php 
                                      $this->db->where('name', $food);
                                      $food_details = $this->db->get('foods')->row();

                                    ?>
                                     <div class="col-xs-3 marRight">
                                        <div class="card card-2">
                                          <div class="card-image-2">
                                            <img src="<?php echo base_url();?>uploads/foods/<?php echo $food_details->image;?>">
                                            <div class="absolute-div">
                                              <p><?php echo $food_details->name;?></p>
                                            </div>
                                          </div>
                                          <!-- <div class="card-details">
                                            <p style="white-space: pre-line;">
                                              <?php echo strip_tags($food->details);?>
                                            </p>
                                          </div> -->
                                        </div>
                                      </div>
                                    <?php endforeach;?>
                                  <?php endif;?>

                                 </div>

                                 <p><?php echo $package->details;?></p>

                              </div>
                            </div>
                          </div>
                        </div>
                  <?php endforeach;?>
                <?php endif;?>
            </div>

            <div class="form-group flex align-center col-xs-12">
            <label for="" class="col-sm-2 control-label">Service Style</label>
            <div class="col-sm-10">
              <div style="display: flex; flex-wrap: wrap;">
              <input type="checkbox" name="service_style[]" class="service_checkbox" style="margin-right: 10px;" value="Plated service">Plated service<small style="margin-left: 25px;flex: 0 0 100%;display: inline-block;"><i>-Selection of pre-plated foods, such as entrees, sandwich plates and salad plates, set on a buffet table. They may also be placed on a roll-in (a i.e., rolling cart or table) and then moved into the function room at the designated time. Because of individual plates, trays are usually used</i></small>
              </div>
              <div style="display: flex; flex-wrap: wrap;">
              <input type="checkbox" name="service_style[]" class="service_checkbox" style="margin-right: 10px;" value="Family or lauriat">Family or lauriat <small style="margin-left: 25px;flex: 0 0 100%;display: inline-block;"><i>-Guests are seated. Large serving platters and bowls are filled with foods in the kitchen and set on the dining tables by servers. Guests help themselves from a lazy Susan or they pass the foods to each other.</i></small>
              </div>
              <div style="display: flex; flex-wrap: wrap;">
              <input type="checkbox" name="service_style[]" class="service_checkbox" style="margin-right: 10px;" value="Buffet">Buffet<small style="margin-left: 25px;flex: 0 0 100%;display: inline-block;"><i>-is a system of serving meals in which food is placed in a public area where the diners serve themselves</i></small>
              </div>
            </div>
          </div>

          <div class="form-group flex align-center col-xs-12">
            <label for="" class="col-sm-2 control-label">Additionals</label>
            <div class="col-sm-10">
              <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;" value="Sounds and light with projector">Sounds and light with projector - 5,000
              <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;margin-left: 10px;" value="Photoboth for 2 hRs">Photoboth for 2 hRs - 4,000
              <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;margin-left: 10px;" value="Photo and video">Photo and video - 3,500
              <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;margin-left: 10px;" value="Emcee">Emcee - 2,000
              <!-- <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;margin-left: 10px;" value="Tiffany chair">Tiffany chair -->
              <input type="checkbox" name="additionals[]" class="additionals_checkbox" style="margin-right: 10px;margin-left: 10px;" value="Motif">Motif - 5,000
            </div>
          </div>

            <div class="">
              <p class="col-sm-2 control-label"><b>Add Foods</b></p>
              <?php 
                $categories = ['Pork', 'Fish', 'Chicken', 'Pasta', 'Beef', 'Drinks', 'Dessert'];
              ?>
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-12 col-md-3">
                  <select class="form-control" id="filterCategory">
                    <?php foreach($categories as $category):?>                  
                        <option value="<?php echo $category;?>"><?php echo $category;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>

              <?php foreach($categories as $category):?>
              <div class="" id="<?php echo $category;?>">
                <p class="col-sm-2 control-label"><b><?php echo $category?></b></p>
                <div class="row"></div>
                <?php 
                $this->db->where('category', $category);
                $res = $this->db->get('foods')->result();
                ?>
                <?php if($res):?>
                  <?php foreach($res as $r):?>

                    <div class="col-xs-4">
                      <div class="card card-2">
                        <div class="card-image-2">
                          <img src="<?php echo base_url();?>uploads/foods/<?php echo $r->image;?>">
                          <div class="absolute-div">
                            <p><?php echo $r->name;?></p>
                            <p><?php echo $r->price;?>/head</p>
                          </div>
                        </div>
                        <div class="card-details">
                          <input type="checkbox" name="foods[]" value="<?php echo $r->id?>"> <small>Select food</small>
                        </div>
                      </div>
                    </div>

                    <!-- <input type="checkbox" name="foods[]" value="<?php echo $r->id?>"> <?php echo $r->name?> - <?php echo $r->price?> <br> -->

                  <?php endforeach;?>
                <?php else:?>
                  <p class="col-sm-2 control-label"></p>
                  <p class="">No foods available.</p>
                <?php endif;?>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          
          <!-- <div class="form-group">
            <label for="" class="col-sm-2 control-label">Assign Team</label>
            <div class="col-sm-10">
              <select class="form-control" name="team" required="">
                <option value="Team A">Team A</option>
                <option value="Team B">Team B</option>
                <option valueails="Team C">Team C</option>
              </select>
            </div>
          </div> -->
          <div class="form-group flex align-center">
            <label for="" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
              <input type="checkbox" name="" class="service_checkbox" value="" required=""> I agree to<a href="#" data-toggle="modal" data-target="#myModal">Terms and Conditions</a>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <!-- <button type="submit" class="btn btn-primary">Next</button> -->
              <input type="submit" name="submit" class="btn btn-primary orange" value="Submit" disabled="" id="btnSubmit">
            </div>
          </div>
      </div>
        </form>
		</div>

      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Terms And Conditions</h4>
          </div>
          <div class="modal-body">
            <ul><li>Slot  reservation 5,000.00</li><li>50% down payment 2 weeks before the event</li><li>50% fill payment at least 3 days before the event</li><li>Our service is up to 5 hours only. If you want to extend the occasion you must pay an additional fee.</li><li>Service of waiter up to 5 hours only, in any excess there will be a charge of P100.00 per hour per waiter including the Driver.</li><li>Charge of P100.00/floor per waiter if the event is held in a building without service elevator.</li><li>Additional charge of P100/waiter if the loading area is 50mts. away from the venue.</li><li>Venue will be only Inside the Camanava Area only.</li><li>Additional P100/waiter for out of town venue including the Driver.</li><li>Any losses, breakages, gate entrance fee, toll fee and caterer’s bond are shouldered by the client.</li><li>LEFTOVERS: In accordance with appropriate Health Codes, CATERER reserves the right to discard any leftover food items, after the agreed upon event timetable, where there is a reasonable risk for food borne illness to occur.</li><li>Cancellation by Acts of God and/or Failure to Provide Service: EDGARDO’S Catering and Events shall have no responsibility or liability for failure to supply any services when prevented from doing so by strikes, accidents, power failure, Acts of God (i.e flood, fire, etc.), or any other.</li><li>Lechon Corkage ( 500/pieces )</li><li>Additional: Main Dish 50/head, Pasta and Vegetable 40/head, Soup 20/head</li><li>Prices are subject to change without prior notice.</li></ul>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    	
    	$(document).ready(function () {
        $('#noGuests').bind('input propertychange', function() {
            val = $(this).val();
            if(val < 100) {
              $(this).addClass('error');
            } else {
              $(this).removeClass('error');
            }
        });

        $('#motif').hide();
        $("#motifSelect").change(function() {
            selected = $("#motifSelect option:selected").text();
            if(selected == 'Others') {
              $('#motif').show();
            }
          });

		     $(".check").on('change', function() {

			 });
		});
    </script>