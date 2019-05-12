<!-- <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script> -->
<style type="text/css">
  .admin-body .container {
    box-shadow: none;
    background: transparent;
  }
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/gcal.js"></script>

<div class="container calendar--container">
    <p>Legend</p>
    <span style="width: 20px;height: 20px;margin:0 5px;background: white;display: inline-block;border:1px solid black;">&nbsp;</span> <small><b>White</b> - Valid date</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: gray;display: inline-block;">&nbsp;</span> <small><b>Gray</b> - Invalid Date</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #FF9800;display: inline-block;">&nbsp;</span> <small><b>Orange</b> - Pending</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #e91e63;display: inline-block;">&nbsp;</span> <small><b>Pink</b> - Team A</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #2196f3;display: inline-block;">&nbsp;</span> <small><b>Blue</b> - Team B</small>
    <span style="width: 20px;height: 20px;margin:0 5px;background: #ffeb3b;display: inline-block;">&nbsp;</span> <small><b>Yellow</b> - Team C</small>

    <div id="calendar"></div>
    <hr>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var base_url = "<?php echo base_url();?>";
    var user_login = "<?php echo $this->session->userdata('id')?>";
    $('#calendar').fullCalendar({
        allDay: true,
        dayRender: function (date, cell) {
            // cell.css("background-color", "#ccc");
            var selected_date = date.format();
            // var selected_date_add_two_months = date.add(2, 'months').format();
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 3; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
              dd = '0' + dd;
            }
            if (mm < 10) {
              mm = '0' + mm;
            }
            today_add_two_months = mm + '-' + dd + '-' + yyyy;
            var strtDt  = new Date(selected_date);
            var endDt  = new Date(today_add_two_months);

            if (endDt <= strtDt){
                //proceed  
                $.ajax({
                    url: base_url + 'calendar/check_date/',
                    dataType: 'json',
                    data: {date: date.unix()},
                    success: function(data) {
                        res = data.schedule_date_count;
                        if(res >= 3) {
                            cell.css("background-color", "#ccc");   
                            $(cell).addClass('disabled');
                        }
                    }
                });
            } else {
                //do not proceed
               cell.css("background-color", "#ccc");    
               $(cell).addClass('disabled');
            }
        },
      // dayClick: function(date, jsEvent, view) {
      // },

      eventSources: [
      {
         events: function(start, end, timezone, callback) {
             $.ajax({
             url: base_url + 'calendar/get_events',
             dataType: 'json',
             data: {
             start: start.unix(),
             end: end.unix()
             },
             success: function(msg) {
                 var events = msg.events;
                 callback(events);
             }
             });
         }
       },
     ],

     eventClick: function(calEvent, jsEvent, view) {
        id = calEvent.id;
        status = calEvent.status;
        if(status == 'pending') {
          window.location.href = base_url + "admin/requests/view/" + id;
        } else {
          window.location.href = base_url + "admin/schedules/view/" + id;
        }

      }


    });


  });

</script>