 <footer>
      <p>&copy; 2018 innovators . all right reserved</p>
      <p>Edgardo's Catering</p>
    </footer>

    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function() {

	  	//hide categories on reservation/details
	  	// $categories = ['Pork', 'Fish', 'Chicken', 'Pasta', 'Beef', 'Drinks', 'Dessert'];
	  	$('#Pork').show();
	  	$('#Fish').hide();
	  	$('#Chicken').hide();
	  	$('#Beef').hide();
	  	$('#Drinks').hide();
	  	$('#Pasta').hide();
	  	$('#Dessert').hide();

	  	$('#filterCategory').change(function (){
	  		var selectedText = $("#filterCategory option:selected").text();
	  		// alert(selectedText);
	  		$('#Pork').hide();
		  	$('#Fish').hide();
		  	$('#Chicken').hide();
		  	$('#Beef').hide();
		  	$('#Drinks').hide();
		  	$('#Pasta').hide();
		  	$('#Dessert').hide();

	  		$('#' + selectedText).show();
	  	});

        $(".service_checkbox").click(function () {
        	// additionals = $('input[name="additionals[]"]:checked').length;
	  		service_style = $('input[name="service_style[]"]:checked').length;
	  		if(service_style){
                $("#btnSubmit").prop("disabled", false);
            } else {
            	$("#btnSubmit").prop("disabled", true);
            }

        });
	  	var base_url = "<?php echo base_url();?>";
	  	var user_login = "<?php echo $this->session->userdata('id')?>";
	  //   $('#calendar').fullCalendar({
	  //   	allDay: true,
	  //   	dayRender: function (date, cell) {
			//     // cell.css("background-color", "#ccc");
			//     var selected_date = date.format();
			//     // var selected_date_add_two_months = date.add(2, 'months').format();
			//     var today = new Date();
			// 	var dd = today.getDate();
			// 	var mm = today.getMonth() + 3; //January is 0!
			// 	var yyyy = today.getFullYear();
			// 	if (dd < 10) {
			// 	  dd = '0' + dd;
			// 	}
			// 	if (mm < 10) {
			// 	  mm = '0' + mm;
			// 	}
			// 	today_add_two_months = mm + '-' + dd + '-' + yyyy;
			// 	var strtDt  = new Date(selected_date);
			// 	var endDt  = new Date(today_add_two_months);

			// 	if (endDt <= strtDt){
			// 	 	//proceed  
			// 	    $.ajax({
			// 	    	url: base_url + 'calendar/check_date/',
			// 	    	dataType: 'json',
			// 	    	data: {date: date.unix()},
			// 	    	success: function(data) {
			// 	    		res = data.schedule_date_count;
			// 	    		if(res >= 3) {
			// 	    			cell.css("background-color", "#ccc");	
			// 	    			$(cell).addClass('disabled');
			// 	    		}
			// 	    	}
			// 	    });
			// 	} else {
			// 		//do not proceed
			// 	   cell.css("background-color", "#ccc");	
			// 	   $(cell).addClass('disabled');
			// 	}
			// },
	  //     dayClick: function(date, jsEvent, view) {

	  //     	$.ajax({
		 //    	url: base_url + 'calendar/check_date/',
		 //    	dataType: 'json',
		 //    	data: {date: date.unix()},
		 //    	success: function(data) {
		 //    		res = data.schedule_date_count;
		 //    		if(res >= 3) {
		 //    			alert('Reservation date is full at the moment. Please select other dates or contact the owner.');
		 //    		} else {
		 //    			var selected_date = date.format();
			// 		    // var selected_date_add_two_months = date.add(2, 'months').format();
			// 		    var today = new Date();
			// 			var dd = today.getDate();
			// 			var mm = today.getMonth() + 3; //January is 0!
			// 			var yyyy = today.getFullYear();
			// 			if (dd < 10) {
			// 			  dd = '0' + dd;
			// 			}
			// 			if (mm < 10) {
			// 			  mm = '0' + mm;
			// 			}
			// 			today_add_two_months = mm + '-' + dd + '-' + yyyy;
			// 			var strtDt  = new Date(selected_date);
			// 			var endDt  = new Date(today_add_two_months);

			// 			if(!user_login) {
			// 		    	if (window.confirm('You must be login first.')) {
			// 				    window.location.href = base_url + 'user/login';
			// 				}
			// 		    } else {
			// 		    	if (endDt <= strtDt){
			// 				 	//proceed  
			// 				 	window.location.href = base_url + 'reservation/details/' + selected_date;	
			// 				} else {
			// 					//do not proceed
			// 				   alert('Reservation Date must be 2 months from date today.');
			// 				}
			// 		    }
		 //    		}
		 //    	}
		 //    });

		    
		 //  },

		 //  eventSources: [
	  //     {
   //           events: function(start, end, timezone, callback) {
   //               $.ajax({
   //               url: base_url + 'calendar/get_events',
   //               dataType: 'json',
   //               data: {
   //               start: start.unix(),
   //               end: end.unix()
   //               },
   //               success: function(msg) {
   //                   var events = msg.events;
   //                   callback(events);
   //               }
   //               });
   //           }
	  //      },
	  //    ],
	  //   });

	    

	  });

	</script>
	<!-- <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script> -->

  </body>
  <!-- // $('#calendar').fullCalendar('gotoDate', '<?php echo $goTodate;?>'); -->
</html>